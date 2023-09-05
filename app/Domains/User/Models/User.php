<?php

namespace App\Domains\User\Models;

use App\Domains\CapTable\Models\CapTable;
use App\Domains\CapTable\Models\CapTableUserOwner;
use App\Domains\Invitation\Models\Invitation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

use function App\Helpers\storeUuid;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'secret_key',
        'email_verified_at',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'secret_key',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            storeUuid($model);
        });
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function capTables(): HasMany
    {
        return $this->hasMany(CapTable::class);
    }

    public function invitedCapTableUser(): HasMany
    {
        return $this->hasMany(CapTableUserOwner::class, 'user_id', 'id');
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }
}
