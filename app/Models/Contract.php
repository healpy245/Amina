<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'client_id', 'dress_id', 'appointment_id', 'deposit_paid', 'signed_at', 'amount', 'start_date', 'end_date', 'status', 'contract_number'
    ];

    protected $casts = [
        'signed_at' => 'datetime',
        'start_date' => 'date',
        'end_date' => 'date',
        'amount' => 'decimal:2',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function dress()
    {
        return $this->belongsTo(Dress::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
