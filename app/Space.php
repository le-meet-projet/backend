<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Space extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name'
    ];

    public function details()
    {
        return $this->hasOne('App\SpaceDetails');
    }

    public function invitations()
    {
        return $this->hasMany('App\Invitation');
    }

    public function ratings()
    {
        return $this->hasMany('App\Rating');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand','id_brand');
    }

    public function scopeCity($query, $request)
    {
        return $query->where('city', '=', $request['city']);
    }

    public function scopeDate($query, $request)
    {
        return $query->where('date', '=', $request['date']);
    }

    public function scopeTime($query, $request)
    {
        return $query->where('time', '=', $request['time']);
    }

    public function scopeCapacity($query, $request)
    {
        return $query->where('capacity', '=', $request['capacity']);
    }

}
