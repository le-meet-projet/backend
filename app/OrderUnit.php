<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderUnit extends Model
{
    protected $table = 'order_unit';

    public function scopeNew($query)
    {
        return $query->where('order_from', '>', now())->orderBy('order_from');
    }


    public function scopeForCurrentUser($query)
    {
        return $query->where('user_id', \Auth::guard('api')->user()->id);
    }

    public function user()
    {
        return $this->belongsTo('\App\User', 'user_id');
    }

    public function order()
    {
        return $this->belongsTo('\App\OrderLeMeet');
    }

    public function meeting()
    {
        return $this->belongsTo('\App\Meeting', 'type_id', 'id');
    }

    public function table()
    {
        return $this->belongsTo('\App\Table', 'type_id', 'id');
    }
}
