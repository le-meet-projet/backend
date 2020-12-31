<?php

namespace App\Http\Controllers;

use App\Helpers\QrCodeHelper;
use App\SpaceSubSpace;
use App\Workshop;
use Illuminate\Http\Request;
use App\Vacation;
use App\Space;
use App\Brand;
use Illuminate\Support\Facades\File;
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
        $vacations = Vacation::orderBy('created_at', 'desc')->paginate(10);
        $brands = Brand::All();
        return view('vacations.index', compact('vacations'), ['brands' => $brands]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::All();
        return view('vacations.create', ['brands' => $brands]);
    }


    public function store(Request $request)
    {
        $input = $this->validate($request, [
            // 'name' => 'required|unique:spaces',
            // 'address' => 'required',
            // 'capacity' => 'required',
            // 'price' => 'required'

        ]);
        $vacations = new Vacation();
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = \public_path('/spaces');
            $image->move($destinationPath, $name);
            $vacations->thumbnail = $name;
            echo "thumbnail";
        }

        $vacations->id_brand = $request->id_brand;
        $vacations->name = $request->name;
        $vacations->address = $request->address;
        $vacations->city = $request->city;
        $vacations->capacity = $request->capacity;
        $vacations->price = $request->price;
        $vacations->post_type = $request->post_type;
        $vacations->period = $request->period;
        $vacations->activity_type = $request->activity_type;
        $vacations->repetition_type = $request->repetition_type;
        $vacations->reservation_type = $request->reservation_type;
        $vacations->percent = $request->percent;
        $vacations->date = $request->date;
        $vacations->description = $request->description;
        $vacations->map = $request->map ?? '';
        if ($request->has('ads')) {
            $vacations->ads = 'yes';
        } else {
            $vacations->ads = 'no';
        }

        if ($files = $request->file('images')) {
            foreach ($files as $file) {
                $name = $file->getClientOriginalName();
                $file->move('spaces', $name);
                $images[] = $name;
            }
        }

        $vacations->gallery = json_encode($images);
        $vacations->save();

        $file = QrCodeHelper::storeQrCode($vacations, 'vacation');
        $vacations->qrcode = $file;
        $vacations->save();

        $spaceSubSpace = new SpaceSubSpace();
        $spaceSubSpace->space_id = $vacations->id;
        $spaceSubSpace->type_space = 'vacation';
        $spaceSubSpace->save();
        Session::flash('statuscode', 'success');
        return redirect()->route('admin.vacations.index')->with('status', 'Vacation Created');

    }

    public function edit($id)
    {
        $brands = Brand::All();
        $content = Vacation::whereId($id)->first();
        return view('vacations.edit', compact('content'), ['brands' => $brands]);
    }


    public function update(Request $request, $id)
    {

        $vacations = Vacation::find($id);


        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = \public_path('/spaces');
            $image->move($destinationPath, $name);
            $vacations->thumbnail = $name;

        }

        $vacations->id_brand = $request->id_brand;
        $vacations->name = $request->name;
        $vacations->address = $request->address;
        $vacations->city = $request->city;
        $vacations->capacity = $request->capacity;
        $vacations->price = $request->price;
        $vacations->period = $request->period;
        $vacations->post_type = $request->post_type;
        $vacations->activity_type = $request->activity_type;
        $vacations->repetition_type = $request->repetition_type;
        $vacations->reservation_type = $request->reservation_type;
        $vacations->percent = $request->percent;
        $vacations->date = $request->date;
        $vacations->description = $request->description;
        $vacations->type = "meeting";
        if ($request->has('ads')) {
            $vacations->ads = 'yes';
        } else {
            $vacations->ads = 'no';
        }
        if ($files = $request->file('images')) {
            foreach ($files as $file) {
                $name = $file->getClientOriginalName();
                $file->move('spaces', $name);
                $images[] = $name;
            }
            $vacations->gallery = json_encode($images);
        }

        $vacations->type = "vacation";
        $vacations->save();

        Session::flash('statuscode', 'info');
        return redirect()->route('admin.vacations.index')->with('status', 'Vacation Updated');

    }

    public function destroy($id)
    {
        $content = Vacation::find($id);
        $files[] = public_path() . '/spaces/' . $content->thumbnail;
        foreach (json_decode($content->gallery, true) as $item ) {
            $files[] = public_path() . '/spaces/' . $item;
        }
        $files[] = public_path() . '/qr_codes/' . $content->qrcode;
        File::delete($files);
        $content->delete();
        $space = SpaceSubSpace::where(['space_id' => $id, 'type_space' => 'vacation'])->first();
        $space->delete();
        Session::flash('statuscode', 'error');
        return redirect()->route('admin.vacations.index')->with('status', 'Vacation Deleted');
    }
}
