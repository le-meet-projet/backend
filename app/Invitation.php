<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invitation extends Model
{
    use SoftDeletes;

    public function space()
    {
        return $this->belongsTo('App\Space');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function creator()
    {
        return $this->belongsTo('App\User', 'creator_id');
    }
}
