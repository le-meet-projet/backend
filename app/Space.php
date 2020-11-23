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
}
