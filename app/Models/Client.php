<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'notes',
        'image',
        'country',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
