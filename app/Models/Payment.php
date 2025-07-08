<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['client_id', 'contract_id', 'amount', 'payment_number', 'status', 'payment_method', 'paid_at', 'deposit'];

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
