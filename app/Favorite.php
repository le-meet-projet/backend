<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favorite extends Model
{
    use SoftDeletes;

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
}
