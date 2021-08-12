<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public static $types = ['hotel', 'restaurant', 'workspace', 'coffee'];

    public function user(){
        return $this->belongsTo('App\User', 'name', 'name'); 
    }

    public function card()
    {
        return $this->hasOne('App\Card');
    }
}
