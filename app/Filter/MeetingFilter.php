<?php

namespace App\Filter;

use App\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MeetingFilter
{

    protected $query;
    public $helper;

    public function __construct()
    {
        $this->helper = new \App\Helpers\Api();
    }

    public function init(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_by' => 'in:closest,popular,top_rating,best_price',
        ]);

        if ($validator->fails())
        {
            return response()->error(400, $validator->errors()->all()[0]);
        }

        $this->query = Meeting::where(['type' => 'meeting']);
        $type = $request->order_by;
        if ($type == 'closest') {
            $validator = \Validator::make($request->all(), [
                'long' => 'numeric', 
                'lat' => 'numeric'
            ]);
            if ($validator->fails()) {
                return response()->error(400, $validator->errors()->first());
            }
            $long = $request->long;
            $lat = $request->lat;
            $this->closest($long, $lat);
        } elseif ($type == 'popular') {
            $this->popular();
        } elseif ($type == 'top_rating') {
            $this->rating();
        } elseif ($type == 'best_price') {
            $this->price();
        }

        return $this->get();
    }

    private function closest($long, $lat)
    {
          $this->query = $this->query->orderBy('created_at', 'DESC');
        return $this;
    }

    private function popular()
    {
        $this->query = $this->query->orderBy('views', 'DESC');
        return $this;
    }

    private function rating()
    {
        //$this->query = $this->query->orderBy('views', 'DESC');
        return $this;
    }

    private function price()
    {
        //  die('okk');
        $this->query = $this->query->orderBy('price', 'ASC');
        return $this;
    }

    private function get()
    {
        return $this->query->get()->map(function ($meeting) {
            return $this->helper->conference($meeting);
        });
    }
}
