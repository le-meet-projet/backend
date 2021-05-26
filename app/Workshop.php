<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Workshop extends Model
{
    use SoftDeletes;

    public function workshopCategory()
    {
        return $this->belongsTo('App\WorkshopCategory');
    }

    public function brand(){
        return $this->belongsTo('App\Brand', 'id_brand'); 
    }
}
