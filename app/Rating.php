<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rating extends Model
{
    use SoftDeletes;

    protected $table = "rating";

    public function spaces()
    {
        return $this->belongsTo('App\Space');
    }

    public function bestValue($r1, $r2)
    {
        return $r1->value > $r2->value;
    }
}
