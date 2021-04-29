<?php 

namespace App\Filter;

use App\Helpers\SpaceClientHelper;
use App\Table;
use App\Vacation;
use Illuminate\Http\Request;

class VacationFilter {

    protected $query;

    public function init(Request $request) {
        $this->query = Vacation::query();
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
        $vacations = $this->query->orderBy('views', 'DESC')->get();
        return SpaceClientHelper::getSapce($vacations, 'vacation');
    }
    
    /**
     * Need to be changed
     */
    private function rating() {
        return $this->get();
    } 
    
    private function price() {
        $vacations = $this->query->orderBy('price', 'ASC')->get();
        return SpaceClientHelper::getSapce($vacations, 'vacation');
    }
    
    private function get() {
        $vacations = $this->query->all();
        return SpaceClientHelper::getSapce($vacations, 'vacation');
        
    }
}