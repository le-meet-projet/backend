<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
<<<<<<< HEAD
    public function user()
    {
        return $this->belongsTo('App\User');
    }
=======
    use SoftDeletes;
>>>>>>> 91eb42f92845b07a4d100dc65602150bdcd44042
}
