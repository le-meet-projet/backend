<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function workshop()
    {
        return $this->belongsTo('App\Workshop');
    }
}
