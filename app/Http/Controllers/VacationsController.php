<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vacation;
use App\Space;
use App\Brand;
use Session;
class VacationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
         
        $vacations=Space::where('type','=','vacation')->paginate(10);
        $brands =Brand::All();
      
        return view('vacations.index',compact('vacations'), ['brands' => $brands]);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {

      
        $brands =Brand::All();
         return view('vacations.create', ['brands' => $brands]);
    }

    
    public function store(Request $request)
    {
        $input= $this->validate($request, [
            // 'name' => 'required|unique:spaces',
            // 'address' => 'required',
            // 'capacity' => 'required',
            // 'price' => 'required'

                    ]);
        
        
       

        $vacations = new Space();
       
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = \public_path('/spaces');
            $image->move($destinationPath,$name);
            $vacations->thumbnail = $name;
            echo "thumbnail";
        }
        
        $vacations->id_brand = $request->id_brand ;
        $vacations->name = $request->name;
        $vacations->address = $request->address;
        $vacations->city = $request->city;
        $vacations->capacity = $request->capacity;
        $vacations->price = $request->price;
        $vacations->period = $request->period;
        $vacations->post_type = $request->post_type;
        $vacations->activity_type = $request->activity_type;
        $vacations->activity_type = $request->activity_type;
        $vacations->percent = $request->percent;
 
        $vacations->type="vacation";
        $vacations->save();

        

        Session::flash('statuscode','success');
        return redirect()->route('admin.vacations.index')->with('status', 'Vacation Created');

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
         return view('vacations.edit',compact('content'));
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
         
        $vacations = Space::find($id);

        
        $vacations->name = $request->name;
        $vacations->address = $request->address;
        $vacations->capacity = $request->capacity;
        $vacations->price = $request->price;
        $vacations->description = $request->description;
        $vacations->gallery = $request->image;
        $vacations->map = $request->map;
        $vacations->type="meeting";
        $vacations->save();
 

        Session::flash('statuscode','info');
        return redirect()->route('admin.vacations.index')->with('status','Vacation Updated');

    }

 

    public function destroy($id)
    {
         
         $content= Space::find($id);
        $content->delete();
        Session::flash('statuscode','error');
        return redirect()->route('admin.vacations.index')->with('status','Vacation Deleted');
    }
}
