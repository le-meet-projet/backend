<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD

class Order extends Model
{
    function user(){

    	return $this->belongsTo('App\User','user_id');
    
    }
=======
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
<<<<<<< HEAD
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function orderDetail()
    {
        return $this->hasMany('App\OrderDetail');
    }

    public function scopePaid()
    {

    }

    public function scopeSearch() {

    }

    public function statue()
    {

    }
=======
    use SoftDeletes;
>>>>>>> 91eb42f92845b07a4d100dc65602150bdcd44042
>>>>>>> c0f64b4bc023dc8e407eb5285d8456332ae169a9
}
