<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Coop;
use App\Models\Transaction;
use App\Actions\Stripe\RefundCharge;
use Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\CoopCanceled;

class CancelExpiredCoops extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cancel-expired-coops';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cancels expired coops and refunds all the purchases that were made to that coop';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = carbon::now()->toDateString();
        $expiredCoops = Coop::with('purchases', 'owner')->where([['status', '!=', 'canceled'], ['expiration_date', '<=', $today]])->get();
        
        foreach ($expiredCoops as $key => $coop) {
            DB::beginTransaction();

            //cancel expired coop
            $coop->status = 'canceled';
            $coop->update();
            
            //Notify the coop's owner
            Mail::to($coop->owner->email)->send(new CoopCanceled($coop));
            
            foreach ($coop->purchases as $key => $purchase) {
                $purchase->coop_canceled = true;
                $purchase->update();
                
                //get purchase transaction
                $purchaseTransaction = $purchase->purchaseTransaction;
                
                if(is_null($purchase->refundTransaction)){
                    //avoid refunding purchase twice
                    $this->refund_purchase($purchase);

                }
            }
            
        }

    }

    /**
     * Refund purchases
     *
     * @param  Purchase  $purchase
     * @return void
     */
    private function refund_purchase($purchase){
        
        try{
            

            if($purchase->purchaseTransaction->source !== 'CreditCard'){
                //if source is not credit card
                //refund with the same source
 
                $memo = 'Refund '.$purchase->source;
                $this->refund_transaction($purchase, $memo);
            }else{
                
                if($purchase->purchaseTransaction->is_pending){
                    //If the credit card hasn't been charged yet 
                    //Cancel the transaction
    
                    $purchase->purchaseTransaction->is_canceled = true;
                    $purchase->purchaseTransaction->update();
                }else{

                    //if the credit card has already been charged, refund the money according to the buyer's refund preference
                    $refundPref = $purchase->buyer->refund_pref;
                    if($refundPref === 'credit'){
                        $memo = 'Refund credit';
                        $this->refund_transaction($purchase, $memo);
                    }else{
                        //For CC refunds use the Stripe helper classes
                        $refundStripe = new RefundCharge();
                        
                        $refund = $refundStripe->refund($purchase->banking_customer_token, $purchase->amount);
                        if($refund){
                            $memo = 'Refund cc';
                            $this->refund_transaction($purchase, $memo);
                        }
                    }
                }
            }

            DB::commit();
        
            Log::info('-[Success] - Purchase ID ' .$purchase->id . ' Has been refunded');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('-[Error] - ' . $e->getMessage(). '-[Line] - ' . $e->getLine());
        }
    }

    /**
     * Refund transaction
     *
     * @param  Purchase  $purchase
     * @param  string  $memo
     * @return void
     */
    private function refund_transaction($purchase, $memo){
        
        try{

            Transaction::create([
                'buyer_id' => $purchase->purchaseTransaction->buyer_id,
                'coop_id' => $purchase->purchaseTransaction->coop_id,
                'purchase_id' => $purchase->purchaseTransaction->purchase_id,
                'type' => 'refund',
                'amount' => $purchase->purchaseTransaction->amount,
                'source' => $purchase->purchaseTransaction->source,
                'memo' => $memo,
                'is_canceled' => true,
                'is_pending' => false
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('-[Error] - ' . $e->getMessage(). '-[Line] - ' . $e->getLine());
        }

    }

}
