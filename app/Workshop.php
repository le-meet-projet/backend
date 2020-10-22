<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Workshop extends Model
{
<<<<<<< HEAD
 
=======
    use SoftDeletes;

>>>>>>> 34c4fa410578a37d6fb24db32486f4235ffae8b0
    public function workshopCategory()
    {
        return $this->belongsTo('App\WorkshopCategory');
    }
<<<<<<< HEAD

    public function gallery()
    {
        return $this->hasMany('App\Gallery');
    }
 
    use SoftDeletes;
 
=======
>>>>>>> 34c4fa410578a37d6fb24db32486f4235ffae8b0
}
