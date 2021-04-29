<?php 

namespace App\Filter;

use App\Helpers\SpaceClientHelper;
use App\Workshop;
use Illuminate\Http\Request;

class WorkshopFilter {

    protected $query;

    public function init(Request $request) {
        $this->query = Workshop::query();
        $validator = \Validator::make($request->all(), [
            'type' => 'string'
        ]);
        if ($validator->fails()) 
            return [
                'error' => $validator->errors()->first()
            ];

        $type = $request->type;
        if ($type === 'closest') {
            $validator = \Validator::make($request->all(), [
                'long' => 'required | numeric', 
                'lat' => 'required | numeric'
            ]);
            if ($validator->fails()) {
                return [
                    'error' => $validator->errors()->first()
                ];
            }
            $long = $request->long;
            $lat = $request->lat;
            return $this->closest($long, $lat);
        }
        elseif ($type === 'popular') return $this->popular();
        elseif ($type === 'rating') return $this->rating();
        elseif ($type === 'price') return $this->price();
        else return $this->get();
    }

    /**
     * Return all the spaces wthout filtring
     */
    private function closest($long, $lat) {
        return $this->get();
    }

    /**
     * Add the view column into the database
     */
    private function popular() {
        $workshops = $this->query->orderBy('views', 'DESC')->get();
        return SpaceClientHelper::getSapce($workshops, 'workshop');
    }
    
    /**
     * Need to be changed
     */
    private function rating() {
        return $this->get();
    } 
    
    private function price() {
        $workshops = $this->query->orderBy('price', 'ASC')->get();
        return SpaceClientHelper::getSapce($workshops, 'workshop');
    }
    
    private function get() {
        $workshops = $this->query->all();
        return SpaceClientHelper::getSapce($workshops, 'workshop');
    }
}