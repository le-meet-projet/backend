<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Space;
use App\workshop;
use Session;

class WorkshopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
       
        $workshops=Space::where('type','=','workshop')->paginate(2);
        return view('workshops.index',compact('workshops'));
   
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('workshops.create');
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


           // 'name' => 'unique:spaces',

         
                    ]);

        $space = new Space();
        $space->name = $request->title;
        $space->address = $request->address;
        $space->date = $request->date;
        $space->time = $request->time;
        $space->capacity = $request->capacity;
        $space->price = $request->price;
        $space->description = $request->description;
        
        $space->type="workshop";
        $space->save();
        Session::flash('statuscode','success');
        return redirect()->route('admin.workshops.index')->with('status', 'Workshop Created');
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
         $content = Space::find($id);
         return view('workshops.edit',compact('content'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        $workshop->type="workshop";
        $workshop->time=$request->hour;
        $workshop->save();

        // $input = $request->all();

        // $space->update($input);
        Session::flash('statuscode','info');
        return redirect()->route('admin.workshops.index')->with('status','Workshop Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Space::find($id)->delete();
        Session::flash('statuscode','error');
        return redirect()->route('admin.workshops.index')->with('status','Workshop Deleted');
    }
}
