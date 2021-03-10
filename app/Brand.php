<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public static $types = ['hotel', 'restaurant', 'workspace', 'coffee'];
}
