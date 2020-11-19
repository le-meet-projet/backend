<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Brand;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Session;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {

        $brand = Brand::orderby('id', 'desc')->paginate(10);
        return view('brand.index', compact('brand'));

      

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
       return view('brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request,[

       
           'name'     => 'required|string|min:4',
           
        ]);

        

        $brand = new Brand;
        $brand->name = $request->input('name');
        $brand->adress = $request->input('adress');
         
        $brand->description = $request->input('description');
      

        $brand->save();


        

        Session::flash('statuscode','success');
        return redirect()->route('admin.brand.index')->with('status', 'Brand Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
         //  $pagination=brand::paginate(2);

         // return view('brand.index', compact('pagination'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|Response|View
     */
     public function edit($id) {
        $content = Brand::find($id);
        return view ('brand.edit',compact('content'));
    }

    public function update(Request $request, $id) {
        $brand = Brand::find($id);

        $brand->name     = $request->name;
        $brand->adress    = $request->adress;
        $brand->description    = $request->description;
     
     
        $brand->save();

       // return redirect()->route('admin.users.index')->with('notification','User successfully updated');

        Session::flash('statuscode','info');
        return redirect()->route('admin.brand.index')->with('status','Brand Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        Brand::find($id)->delete();
        Session::flash('statuscode','error');
        return redirect()->route('admin.brand.index')->with('status','Brand Deleted');
    }
}
