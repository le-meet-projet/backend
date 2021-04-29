<?php

namespace App\Helpers;

class IncrementViewSpaceHelper {

    public static function increment($space) {
        $space->timestamps = false;
        $space->increment('views');
        $space->save();
    }

}