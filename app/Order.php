<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

<<<<<<< HEAD
class Order extends Model
{
    function user()
=======
   
 
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
 
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function orderDetail()
>>>>>>> 5ff9e506ed96118b2e61bf6bdd923ef1a91c1047
    {
        return $this->belongsTo('App\User', 'user_id');
    }
<<<<<<< HEAD
}
=======
 
    use SoftDeletes;
 
}
>>>>>>> 5ff9e506ed96118b2e61bf6bdd923ef1a91c1047
