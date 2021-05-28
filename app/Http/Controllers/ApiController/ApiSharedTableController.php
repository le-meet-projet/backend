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
        $meetings = (new \App\Filter\SharedTableFilter())->init($request);

        if($meetings instanceof Response){
            return $meetings;
        };
        
        return response()->data($meetings);
    
        $tables = Table::get();


        $data = [];
        foreach ($tables as $table) {
            array_push($data, [
                'id' => $table->id,
                'image' => $table->thumbnail != NULL ? env('SHARED_TABLE_THUMBNAIL') . $table->thumbnail : no_image(),
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

        return response()->data($result);
    }
}
