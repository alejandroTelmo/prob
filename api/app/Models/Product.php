<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $attributes = [
        'name',
        'stock',
        'desc',
        'price',
        'cost',
        'img',
        'brand'
    ];
}
