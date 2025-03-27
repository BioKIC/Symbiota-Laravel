<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable, TwoFactorAuthenticatable;

    protected $primaryKey = 'uid';

    const CREATED_AT = 'initialTimestamp';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'firstName',
        'title',
        'lastName',
        'email',
        'institution',
        'department',
        'address',
        'state',
        'city',
        'zip',
        'country',
        'password',
        //Note this is really a orcid
        'dynamicProperties',
        'oauth_provider',
        'guid',
        'access_token',
        'refresh_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'access_token',
        'refresh_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'dynamicProperties' => 'array',
        'password' => 'hashed',
    ];

    public function roles() {
        return $this->hasMany(UserRole::class, 'uid');
    }

    public function hasOneRoles(array $roles) {
        $query = UserRole::query()
            ->where('uid', $this->uid)
            ->select('uid', 'role', 'tablePK');

        $query->where(function ($query) use ($roles) {
            foreach ($roles as $key => $value) {
                if (is_numeric($key)) {
                    $query->orWhere('role', $value);
                } else {
                    $query->orWhere(function (Builder $q) use ($key, $value) {
                        $q->where('role', $key)
                            ->where('tablePK', $value);
                    });
                }
            }
        });

        return $query->first() ? true : false;
    }
}
