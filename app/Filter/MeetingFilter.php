<?php

namespace App\Filter;

use App\Meeting;
use Illuminate\Http\Request;

class MeetingFilter
{

    protected $query;
    public $helper;

    public function __construct()
    {
        $this->helper = new \App\Helpers\Api();
    }




    public function init($request)
    {


        $this->query = Meeting::where(['type' => 'meeting']);
        $type = $request->order_by;
        $long = $request->long;
        $lat = $request->lat;
        if ($type == 'closest') {
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
        //   $this->query = $this->query->orderBy('views', 'DESC');
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
