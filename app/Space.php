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
 
>>>>>>> 5ff9e506ed96118b2e61bf6bdd923ef1a91c1047
}
