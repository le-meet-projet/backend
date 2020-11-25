<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Space;
use App\Brand;
use Session;
use App\QrCode;
class SpaceController extends Controller
{
    
    public function index()
    {  
        $meetings=Space::where('type','=','meeting')->paginate(10);
        $brands =Brand::All();
      
        return view('spacesMeeting.index',compact('meetings'), ['brands' => $brands]);
       
    }

    
    public function create()

    {

      
        $brands =Brand::All();
         return view('spacesMeeting.create', ['brands' => $brands]);
    }

    
    public function store(Request $request)
    {
        $input= $this->validate($request, [
            // 'name' => 'required|unique:spaces',
            // 'address' => 'required',
            // 'capacity' => 'required',
            // 'price' => 'required'

                    ]);
        
        
       

        $space = new Space();
        $space->type_space = $request->type_space;
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = \public_path('/spaces');
            $image->move($destinationPath,$name);
            $space->thumbnail = $name;
            
        }
        
        $space->id_brand = $request->id_brand ;
        $space->name = $request->name;
        $space->address = $request->address;
        $space->city = $request->city;
        $space->capacity = $request->capacity;
        $space->price = $request->price;
        $space->period = $request->period;
        $space->post_type = $request->post_type;
        $space->activity_type = $request->activity_type;
        $space->activity_type = $request->activity_type;
        $space->percent = $request->percent;
        $space->description = $request->description;
        $space->type="meeting";
        if($request->has('ads')){
            $space->ads = 'yes';
        }else{
             $space->ads = 'no';
        }
         if($files=$request->file('images')){
            foreach($files as $file){
                $name=$file->getClientOriginalName();
                $file->move('spaces',$name);
                $images[]=$name;
            }
         }


 
         $space->gallery=json_encode($images);
         $space->qrcode =QrCode::size(250)
        ->backgroundColor(255, 255, 204)
         
        ->generate('ItSolutionStuff.com', public_path('image/qrcode.png'));


        $space->save();

   

        Session::flash('statuscode','success');
        return redirect()->route('admin.spaces.index')->with('status', 'Space Created');

    }
 
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {     
        $brands =Brand::All();
        $content = Space::whereId($id)->first();
         return view('spacesMeeting.edit',compact('content'), ['brands' => $brands]);
    }

    
      public  function update(Request $request, $id)
    {
          
        $space = Space::find($id);

        
       
        $space->type_space = $request->type_space;
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = \public_path('/spaces');
            $image->move($destinationPath,$name);
            $space->thumbnail = $name;
            echo "thumbnail";
        }
        
        $space->id_brand = $request->id_brand ;
        $space->name = $request->name;
        $space->address = $request->address;
        $space->city = $request->city;
        $space->capacity = $request->capacity;
        $space->price = $request->price;
        $space->period = $request->period;
        $space->post_type = $request->post_type;
        $space->activity_type = $request->activity_type;
        $space->activity_type = $request->activity_type;
        $space->percent = $request->percent;
       
        $space->type="meeting";
        if($request->has('ads')){
            $space->ads = 'yes';
        }else{
             $space->ads = 'no';
        }

        if($files=$request->file('images')){
            foreach($files as $file){
                $name=$file->getClientOriginalName();
                $file->move('spaces',$name);
                $images[]=$name;
            }
           $space->gallery=json_encode($images);  
        }
        

        $space->save();

 

        Session::flash('statuscode','info');
        return redirect()->route('admin.spaces.index')->with('status','Space Updated');

    }

   

    public function destroy($id)
    {
         
         $content= Space::find($id);
        $content->delete();
        Session::flash('statuscode','error');
        return redirect()->route('admin.spaces.index')->with('status','Space Deleted');
    }
}
