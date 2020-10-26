<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favorite extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'space_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function space()
    {
        return $this->hasOne('App\Space');
    }
}
