<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function App\Helpers\storeUuid;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            storeUuid($model);
        });
    }

    protected $fillable = [
        'uuid',
        'user_id',
        'image',
        'product_name',
        'product_details',
        'category',
        'type',
        'division',
        'district',
        'area',
        'price',
    ];

    public function offers()
    {
        return $this->hasMany(Offer::class, 'post_id', 'uuid');
    }
}
