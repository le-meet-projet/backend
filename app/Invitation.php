<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    public function space()
    {
        return $this->belongsTo('App\Space');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}