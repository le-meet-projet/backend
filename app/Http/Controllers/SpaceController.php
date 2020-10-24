<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Space;
class SpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $meetings=Space::where('type','=','meeting')->paginate(2);
        return view('spacesMeeting.index',compact('meetings'));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('spacesMeeting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input= $this->validate($request, [
            'name' => 'required|unique:spaces',
            'address' => 'required',
            'capacity' => 'required',
            'price' => 'required'

                    ]);
        
        
       // $input = $request->all();
       // $input->type="meeting";
       // Space::create($input);

        $space = new Space();
        $space->name = $request->name;
        $space->address = $request->address;
        $space->capacity = $request->capacity;
        $space->price = $request->price;
        $space->description = $request->description;
        
        $space->type="meeting";
        $space->save();
        $notification = array(
            'message' => 'Coupon successfully created.',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.spaces.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {     
        $content = Space::whereId($id)->first();
         return view('spacesMeeting.edit',compact('content'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public  function update(Request $request, $id)
    {
         // $input= $this->validate($request, [
         //    'name' => 'unique:spaces',
         //            ]);
        //dd($request);
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

        // $input = $request->all();

        // $space->update($input);
        $notification = array(
            'message' => 'Coupon successfully updated.',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.spaces.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
         
         $content= Space::find($id);
        $content->delete();
        return redirect()->route('admin.spaces.index')->with('success',trans('user.deleted'));
    }
}
