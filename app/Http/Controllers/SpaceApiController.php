<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Space;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SpaceApiController extends Controller
{
    public function index()
    {  
        $meetings=Space::where('type','=','meeting')->paginate(10);
        return new JsonResponse([
            'meetings' => $meetings
        ]);
       
    }

    public function store(Request $request)
    {
        $space = new Space();
        $space->name = $request->name;
        $space->address = $request->address;
        $space->capacity = $request->capacity;
        $space->price = $request->price;
        $space->description = $request->description;
        
        $space->type = "meeting";
        $space->save();

        return new JsonResponse([
            'status' => 'success',
            'message' => 'Space stored successfully'
        ]);

    }

    public function edit($id)
    {     
        $content = Space::whereId($id)->first();
        return new JsonResponse([
            'content' => $content
        ]);
    }

    public  function update(Request $request, $id)
    {
        $space = Space::find($id);

        $space->name = $request->name;
        $space->address = $request->address;
        $space->capacity = $request->capacity;
        $space->price = $request->price;
        $space->description = $request->description;
        $space->gallery = $request->image;
        $space->map = $request->map;
        $space->type="meeting";
        $space->save();

        return new JsonResponse([
            'status' => 'success',
            'message' => 'Space updated successfully'
        ]);

    }

    public function destroy($id)
    {
         
        $content= Space::find($id);
        $content->delete();

        return new JsonResponse([
            'status' => 'success',
            'message' => 'Space deleted successfully'
        ]);
    }
}
