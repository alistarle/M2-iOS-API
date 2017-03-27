<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Monitor extends User
{
    protected $fillable = [
        "vehiculeModel", "vehiculeBrand", "vehiculeYear"
    ];

    /**
     * Return the associated User object
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function user()
    {
        return $this->morphOne('App\User', 'role');
    }

    /**
     * Return list of rates of the monitor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rates()
    {
        return $this->hasMany('App\Models\Rate');
    }

    /**
     * Return list of session of the monitor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sessions()
    {
        return $this->hasMany('App\Models\Session');
    }
}
