<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;

    public function workshop(): BelongsTo
    {
        return $this->belongsTo('App\Workshop');
    }

    public function meeting(): BelongsTo
    {
        return $this->belongsTo(Meeting::class);
    }

    public function space_sub_space(): BelongsTo
    {
        return $this->belongsTo(SpaceSubSpace::class);
    }

    public function user()
    {
        return $this->belongsTo('\App\User', 'user_id', 'id');
    }
}
