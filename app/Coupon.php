<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use SoftDeletes;

<<<<<<< HEAD
    
   protected $fillable = ['code'];


   
=======
     protected $fillable = [
         'code'
     ];
>>>>>>> 86ff9c523bf5816814c17fe129f0d1b5e8fb867d
}
