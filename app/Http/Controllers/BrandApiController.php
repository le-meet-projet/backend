<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BrandApiController extends Controller
{
    public function index()
    {
        $brands = Brand::orderby('id', 'desc')->paginate(10);
        return new JsonResponse([
            'brands' => $brands
        ]);
    }

    public function store(Request $request)
    {
        $brand = new Brand;
        $brand->name = $request->input('name');
        $brand->adress = $request->input('adress');
        $brand->description = $request->input('description');
        if($request->hasFile('thumbnail')){
            $brand->thumbnail = $request->thumbnail->store('thumbnails');
        }

        $brand->save();

        return new JsonResponse([
            'status' => 'success',
            'message' => 'Brand created successfully'
        ]);
    }

     public function edit($id) {
        $content = Brand::find($id);
        return new JsonResponse([
            'content' => $content
        ]);
    }

    public function update(Request $request, $id) {
        $brand = Brand::find($id);

        $brand->name     = $request->name;
        $brand->adress    = $request->adress;
        $brand->description    = $request->description;
        if($request->hasFile('thumbnail')){
            $brand->thumbnail = $request->thumbnail->store('thumbnails');
        }
     
        $brand->save();

        return new JsonResponse([
            'status' => 'success',
            'message' => 'Brand updated successfully'
        ]);

    }

    public function destroy($id)
    {
        Brand::find($id)->delete();
        return new JsonResponse([
            'status' => 'success',
            'message' => 'brand deleted successfully'
        ]);
    }
}
