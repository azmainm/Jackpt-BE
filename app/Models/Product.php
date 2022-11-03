<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'price',
        'slug',
        'discounted_price',
        'description',
        'variant',
        'color',
        'product_image',
        'thumbnail_image',
        'short_image',
    ];

}
