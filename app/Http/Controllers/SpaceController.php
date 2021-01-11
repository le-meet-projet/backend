<?php

namespace App\Http\Controllers;

use App\Helpers\QrCodeHelper;
use App\Meeting;
use App\SpaceSubSpace;
use Illuminate\Http\Request;
use App\Brand;
use Illuminate\Support\Facades\File;
use LaravelQRCode\Facades\QRCode;
use Session;

class SpaceController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'type' => 'required | string'
        ]);
        $type = strtolower($request['type']);
        if ($type !== 'meeting' && $type !== 'conference') return redirect()->route('admin.spaces.index', ['type' => $type]);
        $meetings = Meeting::where(['type' => $type])->orderBy('created_at', 'DESC')->Paginate(10);
        $brands = Brand::All();
        return view('spacesMeeting.index', compact('meetings'), ['brands' => $brands, 'type' => $type]);
    }


    public function create(Request $request)
    {
        $request->validate([
            'type' => 'required | string'
        ]);
        $type = strtolower($request['type']);
        if ($type !== 'meeting' && $type !== 'conference') return redirect()->route('admin.spaces.index', ['type' => $type]);
        $brands = Brand::All();
        return view('spacesMeeting.create', ['brands' => $brands, 'type' => $type]);
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
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = \public_path('/spaces');
            $image->move($destinationPath, $name);
            $space->thumbnail = $name;

        }

        $space->id_brand = $request->id_brand;
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
        $space->map = $request->map ?? '';


        if ($request->has('ads')) {
            $space->ads = 'yes';
        } else {
            $space->ads = 'no';
        }
        if ($files = $request->file('images')) {
            $images = [];
            foreach ($files as $file) {
                $name = $file->getClientOriginalName();
                $file->move('spaces/', $name);
                $images[] = $name;
            }
            $space->gallery = count($images) > 0 ? json_encode($images) : null;
        }
        //   if ($request->hasFile('qrcode')) {
        //     $image = $request->file('qrcode');
        //     $name = time().'.'.$image->getClientOriginalExtension();
        //     $destinationPath = \public_path('/spaces');
        //     $image->move($destinationPath,$name);
        //     $space->qrcode = $name;

        // }

        $space->save();


        
        $types = [
            'meeting' => 'meeting',
            'conference' => 'office'
        ];
        $type = $types[$space->type];
        $code = 'lemeet-'.$type.'-'.$space->id;
        $file = QrCodeHelper::storeQrCode($code);



        $space->qrcode = $file;

        $space->save();

        $space_sub = new SpaceSubSpace();
        $space_sub->space_id = $space->id;
        $space_sub->type_space = $space->type;
        $space_sub->save();

        Session::flash('statuscode', 'success');
        return redirect()->route('admin.spaces.index', ['type' => $request->type_space])->with('status', 'Space Created');

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $brands = Brand::all();
        $content = Meeting::whereId($id)->first();
        return view('spacesMeeting.edit', compact('content'), ['brands' => $brands]);
    }


    public function update(Request $request, $id)
    {
        $space = Meeting::find($id);
        $space->type = $request->type_space;
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = \public_path('/spaces');
            $image->move($destinationPath, $name);
            $space->thumbnail = $name;
        }

        $space->id_brand = $request->id_brand;
        $space->name = $request->name;
        $space->address = $request->address;
        $space->city = $request->city;
        $space->capacity = $request->capacity;
        $space->price = $request->price;
        $space->period = $request->period;
        $space->activity_type = $request->activity_type;
        $space->activity_type = $request->activity_type;
        $space->percent = $request->percent;

        $space->type = "meeting";
        if ($request->has('ads')) {
            $space->ads = 'yes';
        } else {
            $space->ads = 'no';
        }

        if ($files = $request->file('images')) {
            foreach ($files as $file) {
                $name = $file->getClientOriginalName();
                $file->move('spaces', $name);
                $images[] = $name;
            }
            $space->gallery = json_encode($images);
        }
        $space->save();
        Session::flash('statuscode', 'info');
        return redirect()->route('admin.spaces.index')->with('status', 'Space Updated');

    }


    public function destroy($id)
    {
        $content = Meeting::find($id);
        $type = $content->type;
        $files[] = public_path() . '/spaces/' . $content->thumbnail;
        if ($content->gallery !== null) {
            foreach (json_decode($content->gallery, true) as $item) {
                $files[] = public_path() . '/spaces/' . $item;
            }
        }
        $files[] = public_path() . '/qr_codes/' . $content->qrcode;
        File::delete($files);
        $spaceSub = SpaceSubSpace::where(['space_id' => $id, 'type_space' => $content->type]);
        $content->delete();
        $spaceSub->delete();
        Session::flash('statuscode', 'error');
        return redirect()->route('admin.spaces.index', ['type' => $type])->with('status', 'Space Deleted');
    }
}
