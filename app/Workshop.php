<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    public function workshopCategory()
    {
        return $this->belongsTo('App\WorkshopCategory');
    }

    public function gallery()
    {
        return $this->hasMany('App\Gallery');
    }
}
