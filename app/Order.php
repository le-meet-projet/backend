<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
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

    public function detail()
    {
        //return $this->belongsTo('App\User', 'user_id');
        return $this->hasOne('App\OrderDetail');
    }

<<<<<<< HEAD
    
=======
>>>>>>> 86ff9c523bf5816814c17fe129f0d1b5e8fb867d

    /**
     *
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeSearch(Builder $query)
    {
    }

    /**
     *
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopePaied(Builder $query)
    {
        return  $query->where('status','paid');
    }

    use SoftDeletes;
}
