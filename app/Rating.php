<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rating extends Model
{
    use SoftDeletes;

    protected $table = "rating";

    public function space_sub_space(): BelongsTo
    {
        return $this->belongsTo(SpaceSubSpace::class, 'meeting_id');
    }

    public function bestValue($r1, $r2): bool
    {
        return $r1->value > $r2->value;
    }
}
