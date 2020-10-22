<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function courseCategory()
    {
        return $this->belongsTo('App\CourseCategory');
    }
}
