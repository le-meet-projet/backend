<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
<<<<<<< HEAD
 
=======
>>>>>>> 34c4fa410578a37d6fb24db32486f4235ffae8b0
    public function user()
    {
        return $this->belongsTo('App\User');
    }
<<<<<<< HEAD
 
    use SoftDeletes;
 
=======

    
    use SoftDeletes;
>>>>>>> 34c4fa410578a37d6fb24db32486f4235ffae8b0
}
