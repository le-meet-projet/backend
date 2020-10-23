<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



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
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function statue()
    {
    }

    public function scopeSearch($query)
    {
    }

    public function scopePaied($query)
    {
    }

    use SoftDeletes;
}
