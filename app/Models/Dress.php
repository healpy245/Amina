<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dress extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'status',
        'times_rented',
        'image',
        'price',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
}
