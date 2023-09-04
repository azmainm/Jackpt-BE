<?php

namespace App\Models;

use function App\Helpers\storeUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $table = 'offers';

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            storeUuid($model);
        });
    }

    protected $fillable = [
        'uuid',
        'post_id',
        'user_id',
        'service_name',
        'service_details',

    ];

    function post()
    {
        return  $this->belongsTo(Post::class);
    }
}
