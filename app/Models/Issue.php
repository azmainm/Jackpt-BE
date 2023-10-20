<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function App\Helpers\storeUuid;

class  Issue extends Model
{
    use HasFactory;

    protected $table = 'issues';


//    public static function boot()
//    {
//        parent::boot();
//        self::creating(function ($model) {
//            storeUuid($model);
//        });
//    }

    protected $fillable = [
        'title',
        'description',
        'is_solved',
    ];
}
