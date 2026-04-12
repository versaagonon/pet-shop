<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'category', 'price', 'bought_price', 'stock', 'unit', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
