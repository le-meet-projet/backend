<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Favorite extends Model
{

    protected $fillable = [
        'user_id',
        'space_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }

    public function space(): HasOne
    {
        return $this->hasOne('App\Space');
    }
    public function meeting()
    {
        return $this->belongsTo('App\Meeting', 'type_id');
    }

    public function workshop()
    {
        return $this->belongsTo('App\Workshop', 'type_id');
    }


    public function vacation()
    {
        return $this->belongsTo('App\Vacation', 'type_id');
    }


    public function shared_table()
    {
        return $this->belongsTo('App\Table', 'type_id');
    }
}
