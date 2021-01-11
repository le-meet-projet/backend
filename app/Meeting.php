<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meeting extends Model
{
    use SoftDeletes;


    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function favorite(){
        //->where('type', 'meeting')
        return $this->belongsTo('App\Favorite','type_id'); 
    }


    // whereHas('director', function($q) {
    //     $q->where('name', 'great');
    // })


}
