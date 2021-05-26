<?php 

namespace App\Filter;

use App\Helpers\SpaceClientHelper;
use App\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OfficeFilter {

    protected $query;

    public function init(Request $request) {
        $validator = Validator::make($request->all(), [
            'type' => 'string | in:closest,popular,rating,price'
        ]);
        if ($validator->fails()) {
            return response()->error(400, $validator->errors()->first());
        }

        $this->query = Meeting::where(['type' => 'conference']);
        $type = $request->type;
        if ($type === 'closest') {
            $validator = \Validator::make($request->all(), [
                'long' => 'numeric', 
                'lat' => 'numeric'
            ]);
            if ($validator->fails()) {
                return response()->error(400, $validator->errors()->first());
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
        $meetings = $this->query->orderBy('views', 'DESC')->get();
        return SpaceClientHelper::getSapce($meetings, 'conference');
    }
    
    /**
     * Need to be changed
     */
    private function rating() {
        return $this->get();
    } 
    
    private function price() {
        $meetings = $this->query->orderBy('price', 'ASC')->get();
        return SpaceClientHelper::getSapce($meetings, 'conference');
    }
    
    private function get() {
        $meetings = $this->query->get();
        return SpaceClientHelper::getSapce($meetings, 'conference');
    }
    
}