<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';

    protected $fillable = [
        'uuid',
        'user_id',
        'image',
        'product_name',
        'product_details',
        'category',
        'type'
    ];

}
