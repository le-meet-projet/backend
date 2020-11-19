<?php

namespace App\Http\Controllers;

use App\Space;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WorkshopApiController extends Controller
{
    public function index()
    {   
        $workshops = Space::where('type','=','workshop')->paginate(10);
        return new JsonResponse([
            'workshops' => $workshops
        ]);
    }

    public function store(Request $request)
    {

        $space = new Space();
        $space->name = $request->title;
        $space->address = $request->address;
        $space->date = $request->date;
        $space->time = $request->time;
        $space->capacity = $request->capacity;
        $space->price = $request->price;
        $space->description = $request->description;
        $space->type = "workshop";

        $space->save();

        return new JsonResponse([
            'status' => 'success',
            'message' => 'Workshop created successfully'
        ]);
    }

    public function edit($id)
    {
         $content = Space::find($id);
         return new JsonResponse([
            'content' => $content
        ]);
    }

    public function update(Request $request, $id)
    {
        $workshop = Space::find($id);

        $workshop->name = $request->title;
        $workshop->address = $request->address;
        $workshop->capacity = $request->capacity;
        $workshop->price = $request->price;
        $workshop->description = $request->description;
        $workshop->gallery = $request->image;
        $workshop->map = $request->map;
        $workshop->type = "workshop";
        $workshop->time = $request->hour;
        $workshop->date = $request->date;
        $workshop->save();

        return new JsonResponse([
            'status' => 'success',
            'message' => 'Workshop updated successfully'
        ]);

    }

    public function destroy($id)
    {
        Space::find($id)->delete();
        return new JsonResponse([
            'status' => 'success',
            'message' => 'Workshop deleted successfully'
        ]);
    }
}
