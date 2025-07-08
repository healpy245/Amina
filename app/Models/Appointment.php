<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['client_id', 'date', 'time', 'notes', 'type', 'dress_type'];

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime:H:i',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
