<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $fillable = [
        "rate"
    ];

    /**
     * Return the associated monitor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function monitor()
    {
        return $this->belongsTo('App\Models\Monitor');
    }

    /**
     * Return the associated student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }
}
