<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatarUrl', 'phone', 'address', 'cp', 'city', 'range_km', 'price'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Retur whether a Monitor/Student object associated
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function role()
    {
        return $this->morphTo();
    }

    /**
     * Return User's sessions
     *
     * @return mixed
     */
    public function sessions()
    {
        return $this->role->sessions();
    }
}
