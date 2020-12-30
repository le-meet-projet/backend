<?php

namespace App\Http\Controllers;

use App\SpaceSubSpace;
use Illuminate\Http\Request;
use App\Space;
use App\Workshop;
use Session;
use App\Brand;

class WorkshopController extends Controller
{

    public function index()
    {
        $brands = Brand::All();
        $workshops= Workshop::paginate(10);
        return view('workshops.index',compact('workshops'), ['brands' => $brands]);
    }


    public function create()
    {
        $brands =Brand::All();
        return view('workshops.create', ['brands' => $brands]);
    }

    public function store(Request $request)
    {
        $input= $this->validate($request, [


          //  'name' => 'unique:spaces',
        ]);


        $workshop = new Workshop();
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = \public_path('/spaces');
            $image->move($destinationPath,$name);
            $workshop->thumbnail = $name;

        }
        $workshop->name = $request->name;
        $workshop->id_brand = $request->id_brand ;

        $workshop->address = $request->address;
        $workshop->city = $request->city;
        $workshop->capacity = $request->capacity;
        $workshop->price = $request->price;
        $workshop->period = $request->period;
        $workshop->activity_type = $request->activity_type;
        $workshop->repetition_type = $request->repetition_type;
        $workshop->reservation_type = $request->reservation_type;
        $workshop->percent = $request->percent;
        $workshop->date = $request->date;
        $workshop->time = $request->time;
        $workshop->description = $request->description;
        $workshop->map = $request->map ?? '';
        if($request->has('ads')){
            $workshop->ads = 'yes';
        }else{
             $workshop->ads = 'no';
        }
         if($files=$request->file('images')){
            foreach($files as $file){
                $name=$file->getClientOriginalName();
                $file->move('spaces',$name);
                $images[]=$name;
            }$workshop->gallery=json_encode($images);
         }

        $workshop->save();

        $spaceSubSpace = new SpaceSubSpace();
        $spaceSubSpace->space_id = $workshop->id;
        $spaceSubSpace->type_space = 'workshop';
        $spaceSubSpace->save();
        return redirect()->route('admin.workshops.index')->with('notification','workshop successfully created');

        Session::flash('statuscode','success');
        return redirect()->route('admin.workshops.index')->with('status', 'Workshop Created');

    }


    public function edit($id)
    {
         $content = Space::find($id);
         $brands =Brand::All();
         return view('workshops.edit',compact('content'), ['brands' => $brands]);

    }


    public function update(Request $request, $id)
    {
        $workshop = Space::find($id);


        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = \public_path('/spaces');
            $image->move($destinationPath,$name);
            $workshop->thumbnail = $name;

        }

        $workshop->id_brand = $request->id_brand ;
        $workshop->name = $request->name;
        $workshop->address = $request->address;
        $workshop->city = $request->city;
        $workshop->capacity = $request->capacity;
        $workshop->price = $request->price;
        $workshop->period = $request->period;
        $workshop->post_type = $request->post_type;
        $workshop->activity_type = $request->activity_type;
        $workshop->repetition_type = $request->repetition_type;
        $workshop->reservation_type = $request->reservation_type;
        $workshop->percent = $request->percent;
        $workshop->date = $request->date;
        $workshop->time = $request->time;
        $workshop->description = $request->description;
        $workshop->type="meeting";
        if($request->has('ads')){
            $workshop->ads = 'yes';
        }else{
             $workshop->ads = 'no';
        }
         if($files=$request->file('images')){
            foreach($files as $file){
                $name=$file->getClientOriginalName();
                $file->move('spaces',$name);
                $images[]=$name;
            }$workshop->gallery=json_encode($images);
         }



        $workshop->type="workshop";
        $workshop->save();


        return redirect()->route('admin.workshops.index')->with('notification','workshop successfully updated');

        Session::flash('statuscode','info');
        return redirect()->route('admin.workshops.index')->with('status','Workshop Updated');

    }


    public function destroy(int $id)
    {
        Space::find($id)->delete();
        SpaceSubSpace::where(['space_id' => $id, 'type_space' => 'workshop'])->delete;
        Session::flash('statuscode','error');
        return redirect()->route('admin.workshops.index')->with('status','Workshop Deleted');
    }
}
