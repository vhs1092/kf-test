<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CoopCanceled extends Mailable
{
    use Queueable, SerializesModels;

    private $coop;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($coop)
    {
        $this->coop = $coop;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.coop-canceled')
        ->subject('Coop Canceled')->with([
            'coop' => $this->coop
        ]);;
        
    }
}
