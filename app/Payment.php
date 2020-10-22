<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
 
    public function user()
    {
        return $this->belongsTo('App\User');
    }
 
    use SoftDeletes;
 
}
