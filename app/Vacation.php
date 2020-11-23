<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vacation extends Model
{
    use SoftDeletes;

    public function vacationCategory()
    {
        return $this->belongsTo('App\vacationCategory');
    }
}
