<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD

class Space extends Model
{
    //
=======
use Illuminate\Database\Eloquent\SoftDeletes;

class Space extends Model
{
    use SoftDeletes;
>>>>>>> c0f64b4bc023dc8e407eb5285d8456332ae169a9
}
