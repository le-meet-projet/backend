<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Table extends Model
{
    use SoftDeletes;

    public function favorite(){
        return $this->belongsTo('App\Favorite','type_id'); 
    }

    public function brand(){
        return $this->belongsTo('App\Brand', 'id_brand'); 
    }
}