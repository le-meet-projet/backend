<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Brand;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Http\Helpers\Stripe;
use Session;
use Illuminate\Support\Facades\Validator;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {

        $brands = Brand::orderby('id', 'desc')->paginate(10);
        return view('brand.index', compact('brands'));

      

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
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|min:4'
        ]);

        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        //create user 
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->password);
        $user->role = 'brand';
        $user->save();
        //////

        $brand = new Brand;
        $brand->name = $request->input('name');
        $brand->regular_est_name = $request->regular_est_name;
        $brand->com_registration_number = $request->com_registration_number;
        $brand->address = $request->input('address');
        $brand->description = $request->input('description');

        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = \public_path('/brands');
            $image->move($destinationPath, $name);
            $brand->thumbnail = $name;

        }

        if ($request->hasFile('gallery')) {
            $images = [];
            foreach ($request->file('gallery') as $file) {
                $name = $file->getClientOriginalName();
                $file->move('brands/', $name);
                $images[] = $name;
            }
            $brand->gallery = count($images) > 0 ? json_encode($images) : null;
        }

        if ($request->hasFile('files')) {
            $files = [];
            foreach ($request->file('files') as $file) {
                $name = $file->getClientOriginalName();
                $file->move('brands/files/', $name);
                $files[] = $name;
            }
            $brand->gallery = count($images) > 0 ? json_encode($files) : null;
        }

        $brand->iban = $request->input('iban');
        $brand->bank = $request->input('bank');
        $brand->type = $request->input('type');
        $brand->save();

        (new Stripe)->createCustomer($request->input('email'));

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
        $brand->address    = $request->address;
        $brand->regular_est_name = $request->regular_est_name;
        $brand->com_registration_number = $request->com_registration_number;
        $brand->description    = $request->description;
        if($request->hasFile('thumbnail')){
            $brand->thumbnail = $request->thumbnail->store('thumbnails');
        }

        if ($request->hasFile('gallery')) {
            $images = [];
            foreach ($request->file('gallery') as $file) {
                $name = $file->getClientOriginalName();
                $file->move('brands/', $name);
                $images[] = $name;
            }
            $brand->gallery = count($images) > 0 ? json_encode($files) : null;
        }

        if ($request->hasFile('files')) {
            $files = [];
            foreach ($request->file('files') as $file) {
                $name = $file->getClientOriginalName();
                $file->move('brands/files/', $name);
                $files[] = $name;
            }
            $brand->gallery = count($images) > 0 ? json_encode($images) : null;
        }

        $brand->iban = $request->iban;
        $brand->bank = $request->bank;
        $brand->type = $request->type;

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
        (new Stripe)->deleteCustomer($id);
        Brand::find($id)->user()->delete();
        Brand::find($id)->delete();
        Session::flash('statuscode','error');
        return redirect()->route('admin.brand.index')->with('status','Brand Deleted');
    }
}
