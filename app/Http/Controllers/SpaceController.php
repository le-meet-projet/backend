<?php

namespace App\Http\Controllers;

use App\Meeting;
use App\SpaceSubSpace;
use Illuminate\Http\Request;
use App\Space;
use App\Brand;
use Session;
use App\QrCode;

class SpaceController extends Controller
{

    public function index()
    {
        $meetings = Meeting::Paginate(10);
        $brands = Brand::All();
        return view('spacesMeeting.index',compact('meetings'), ['brands' => $brands]);
    }


    public function create()
    {
        $brands = Brand::All();
        return view('spacesMeeting.create', ['brands' => $brands]);
    }

    public function store(Request $request)
    {
        $input = $this->validate($request, [
            // 'name' => 'required|unique:spaces',
            // 'address' => 'required',
            // 'capacity' => 'required',
            // 'price' => 'required'
        ]);


        $space = new Meeting();
        $space->type = $request->type_space;
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
        $space->activity_type = $request->activity_type;
        $space->activity_type = $request->activity_type;
        $space->percent = $request->percent;
        $space->description = $request->description;
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
          $space->qrcode = $request->qrcode;
        //   if ($request->hasFile('qrcode')) {
        //     $image = $request->file('qrcode');
        //     $name = time().'.'.$image->getClientOriginalExtension();
        //     $destinationPath = \public_path('/spaces');
        //     $image->move($destinationPath,$name);
        //     $space->qrcode = $name;

        // }

        $space->save();

        $space_sub = new SpaceSubSpace();
        $space_sub->space_id = $space->id;
        $space_sub->type_space = $space->type;
        $space_sub->save();

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
        $content= Meeting::find($id);
        $spaceSub = SpaceSubSpace::where(['space_id' => $id, 'type_space' => $content->type]);
        $content->delete();
        $spaceSub->delete();
        Session::flash('statuscode','error');
        return redirect()->route('admin.spaces.index')->with('status','Space Deleted');
    }
}
