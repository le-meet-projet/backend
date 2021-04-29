<?php 

namespace App\Filter;

use App\{Meeting,Table};
use Illuminate\Http\Request;

class SharedTableFilter {

    protected $query;
    public $helper ;

    public function __construct(){
        $this->helper = new \App\Helpers\Api();
     
    }
    
 


    public function init($request) {

        $this->query = Table::query();
        $type = $request->order_by;
        $long = $request->long;
        $lat = $request->lat;
        if($type == 'closest') {
             $this->closest($long, $lat);
        }elseif ($type == 'popular') {
            $this->popular();
        }elseif ($type == 'top_rating') {
            $this->rating();
        }elseif ($type == 'best_price') {
            $this->price();
        }
                
        return $this->get();
    }

    private function closest($long, $lat) {
   //   $this->query = $this->query->orderBy('views', 'DESC');
        return $this;
    }
  
    private function popular() {
        $this->query = $this->query->orderBy('views', 'DESC');
        return $this;
    }

    private function rating() {
     //$this->query = $this->query->orderBy('views', 'DESC');
        return $this;
    } 
    
    private function price() {
      //  die('okk');
        $this->query = $this->query->orderBy('price', 'ASC');
        return $this;
    }
    
    private function get() {
        return $this->query->get()->map(function($table) {
            return [
                'id' => $table->id,
                'image' => $table->thumbnail != NULL ? env('SPACE_THUMBNAIL') . $table->thumbnail : env('NO_IMAGE'),
                'place_name' => $table->name,
                'price' => $table->price,
                'rate' => '5/5',
                'location' => $table->address
            ];
        });
    }
}