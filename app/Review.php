<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
<<<<<<< HEAD
 
=======
    use SoftDeletes;

>>>>>>> 34c4fa410578a37d6fb24db32486f4235ffae8b0
    public function workshop()
    {
        return $this->belongsTo('App\Workshop');
    }
<<<<<<< HEAD
 
    use SoftDeletes;
 
=======
>>>>>>> 34c4fa410578a37d6fb24db32486f4235ffae8b0
}
