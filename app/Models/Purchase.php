<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $with = ['transactions', 'purchaseTransaction', 'refundTransaction', 'buyer'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function purchaseTransaction()
    {
        return $this->hasOne(Transaction::class)->ofType('purchase');
    }

    public function refundTransaction()
    {
        return $this->hasOne(Transaction::class)->ofType('refund');
    }

    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }
}
