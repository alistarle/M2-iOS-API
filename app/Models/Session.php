<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Session extends Model
{
    protected $fillable = [
        'from', 'to', 'description', 'rate', 'status', 'sessionDate', 'begin', 'end', 'distance'
    ];

    protected $geofields = ['departure', 'arrival'];

    /**
     * Return the associated creator User ( Monitor or Student )
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'creator_id');
    }

    /**
     * Return the associated Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

    /**
     * Return the associated Monitor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function monitor()
    {
        return $this->belongsTo('App\Models\Monitor');
    }

    /**
     * Set the given Arrival attribute as POINT field
     *
     * @param $value
     */
    public function setDepartureAttribute($value) {
        $this->attributes['departure'] = DB::raw("POINT($value)");
    }

    /**
     * Return the Departure attribute as lat,lng value
     *
     * @param $value
     * @return string
     */
    public function getDepartureAttribute($value){

        $loc =  substr($value, 6);
        $loc = preg_replace('/[ ,]+/', ',', $loc, 1);

        return substr($loc,0,-1);
    }

    /**
     * Set the given Arrival attribute as POINT field
     *
     * @param $value
     */
    public function setArrivalAttribute($value) {
        $this->attributes['arrival'] = DB::raw("POINT($value)");
    }

    /**
     * Return the Arrival attribute as lat,lng value
     *
     * @param $value
     * @return string
     */
    public function getArrivalAttribute($value){

        $loc =  substr($value, 6);
        $loc = preg_replace('/[ ,]+/', ',', $loc, 1);

        return substr($loc,0,-1);
    }

    /**
     * Used to parse Geometrical data
     *
     * @param bool $excludeDeleted
     * @return $this
     */
    public function newQuery($excludeDeleted = true)
    {
        $raw=[];
        foreach($this->geofields as $column){
            $raw[] = ' astext('.$column.') as '.$column.' ';
        }

        return parent::newQuery($excludeDeleted)->addSelect('*',DB::raw(implode(",",$raw)));
    }

    /**
     * Return sessions where departure match the given distance
     *
     * @param $query
     * @param $dist
     * @param $location
     * @return mixed
     */
    public function scopeDistance($query,$dist,$location)
    {
        return $query->whereRaw('st_distance(departure,POINT('.$location.')) < '.$dist);
    }

    /**
     * Return only session who are in created state ( listen to a match )
     *
     * @param $query
     * @return mixed
     */
    public function scopeStatusCreated($query)
    {
        return $query->where('status', 0);
    }

    /**
     * Filter result by price below the given arg
     *
     * @param $query
     * @param $price
     * @return mixed
     */
    public function scopePrice($query, $price)
    {
        return $query->whereHas('monitor', function($q) use($price){
            return $q->whereHas('user', function($q2) use($price){
                $q2->where('price',"<=", $price);
            });
        })->orWhereHas('student', function($q) use($price){
            return $q->whereHas('user', function($q2) use($price){
                $q2->where('price',"<=", $price);
            });
        });
    }

    /**
     * Return adapted session for role of user ( Student session for monitor and opposite )
     *
     * @param $query
     */
    public function scopeRole($query, $user)
    {
        return ($user->role instanceof Student) ? $this->where('student_id', null) : $this->where('monitor_id', null);
    }

}
