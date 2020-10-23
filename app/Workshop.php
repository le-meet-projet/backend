<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Workshop extends Model
{
<<<<<<< HEAD
    public function workshopCategory()
    {
        return $this->belongsTo('App\WorkshopCategory');
    }

    public function gallery()
    {
        return $this->hasMany('App\Gallery');
    }
=======
    use SoftDeletes;
>>>>>>> 91eb42f92845b07a4d100dc65602150bdcd44042
}
