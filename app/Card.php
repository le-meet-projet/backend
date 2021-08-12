<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = ['stripe_cus_id'];

    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }
}
