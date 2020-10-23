<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    public function course()
    {
        return $this->hasMany('App\Course');
    }
}
