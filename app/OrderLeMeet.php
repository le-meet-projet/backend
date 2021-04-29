<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderLeMeet extends Model
{
    protected $table = 'lemeet_orders';

    protected $guarded = ['id'];


    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }


    public function scopeLoading($query)
    {
        if ($this->type == 'meeting') {
            return $query->with(['user', 'meeting']);
        }
        if ($this->type == 'shared_table') {
            return $query->with(['user', 'shared_table']);
        }
    }

    public function thumbnai($query)
    {
        if ($this->type == 'meeting') {
            return $query->meeting->thumbnail;
        }
        if ($this->type == 'shared_table') {
            return $query->shared_table->thumbnail;
        }
    }

    public function meeting()
    {
        return $this->hasOne('App\Meeting', 'id', 'type_id');
    }

    public function shared_table()
    {
        return $this->hasOne('App\Table', 'id', 'type_id');
    }

    public function users()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }


    public function spaceMeeting()
    {
        return $this->belongsTo('\App\Meeting', 'type_id')->where('type', 'meeting');
    }


    public function spaceShared_table()
    {
        return $this->belongsTo('\App\Table', 'type_id');
    }


    public function spaceOffice()
    {
        return $this->belongsTo('\App\Meeting', 'type_id')->where('type', 'conference');
    }
}
