<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
