<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Table;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Request;

class ApiSharedTableController extends Controller
{
    public function index(Request $request)
    {

        
        $type = $request->order_by;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $meetings = (new \App\Filter\SharedTableFilter())->init($request);

    
        $api = [];
        $api['state'] = true;
        $api['message'] = '';
        $api['data'] = $meetings;
        return response()->json($api);
    


        //dd('ldldd');
        $tables = Table::get();


        $data = [];
        foreach ($tables as $table) {
            array_push($data, [
                'id' => $table->id,
                'image' => $table->thumbnail != NULL ? env('SPACE_THUMBNAIL') . $table->thumbnail : env('NO_IMAGE'),
                'place_name' => $table->name,
                'price' => $table->price,
                'rate' => '5/5',
                'location' => $table->address
            ]);
        }

        if (!$tables) {
            $result = [
                'state' => false,
                'message' => 'Not found !',
                'data' => [],
            ];
        } else {
            $result = [
                'state' => true,
                'message' => '',
                'data' => $data
            ];
        }

        return response($result);
    }
}
