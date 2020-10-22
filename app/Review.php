<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
 
    public function workshop()
    {
        return $this->belongsTo('App\User');
    }
 
    use SoftDeletes;
 
}
