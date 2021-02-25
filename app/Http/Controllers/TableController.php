<?php 


namespace App\Http\Controllers;

use App\Brand;
use App\Table;
use Illuminate\Http\Request;
use App\Helpers\QrCodeHelper;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Support\Facades\File;

class TableController extends Controller 
{

    public function index()
    {
        $tables = Table::paginate(10);
        $brands = Brand::all();
        return view('tables.index', compact(['tables', 'brands']));
    }

    public function create()
    {
        $brands = Brand::all();
        return \view('tables.create', \compact(['brands']));
    }

    public function store(Request $request)
    {
        $table = new Table();
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = \public_path('/tables');
            $image->move($destinationPath, $name);
            $table->thumbnail = $name;

        }

        $table->id_brand = $request->id_brand;
        $table->name = $request->name;
        $table->address = $request->address;
        $table->city = $request->city;
        $table->capacity = $request->capacity;
        $table->options = json_encode($request->properties);
        $table->price = $request->price;
        $table->percent = $request->percent;
        $table->iban = $request->iban;
        $table->description = $request->description;
        $table->map = $request->map ?? '';
        $table->lat = $request->lat ?? '';
        $table->longitude = $request->longitude;
        $table->latitude = $request->latitude;


        if ($request->has('ads')) {
            $table->ads = 'yes';
        } else {
            $table->ads = 'no';
        }
        if ($files = $request->file('images')) {
            $images = [];
            foreach ($files as $file) {
                $name = $file->getClientOriginalName();
                $file->move('tables/', $name);
                $images[] = $name;
            }
            $table->gallery = count($images) > 0 ? json_encode($images) : null;
        }

        $table->save();
        
        $code = 'lemeet-'.$table->name.'-'.$table->id;
        $file = QrCodeHelper::storeQrCode($code);

        $table->qrcode = $file;

        $table->save();

        Session::flash('statuscode', 'success');
        return redirect()->route('admin.tables.index')->with('status', 'Table Created');
    }

    public function edit(int $id)
    {
        $table = Table::find($id);
        $brands = Brand::all();
        return view('tables.edit', [
            'content' => $table,
            'brands' => $brands
        ]);
    }

    public function update(Request $request, int $id)
    {
        $table = Table::find($id);
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = \public_path('/spaces');
            $image->move($destinationPath, $name);
            $table->thumbnail = $name;

        }

        $table->id_brand = $request->id_brand;
        $table->name = $request->name;
        $table->address = $request->address;
        $table->city = $request->city;
        $table->capacity = $request->capacity;
        $table->options = json_encode($request->properties);
        $table->price = $request->price;
        $table->percent = $request->percent;
        $table->iban = $request->iban;
        $table->description = $request->description;
        $table->map = $request->map ?? '';
        $table->lat = $request->lat ?? '';
        $table->longitude = $request->longitude;
        $table->latitude = $request->latitude;


        if ($request->has('ads')) {
            $table->ads = 'yes';
        } else {
            $table->ads = 'no';
        }
        if ($files = $request->file('images')) {
            $images = [];
            foreach ($files as $file) {
                $name = $file->getClientOriginalName();
                $file->move('spaces/', $name);
                $images[] = $name;
            }
            $table->gallery = count($images) > 0 ? json_encode($images) : null;
        }

        $table->save();

        Session::flash('statuscode', 'success');
        return redirect()->route('admin.tables.index')->with('status', 'Table Updated');
    }

    public function delete(int $id)
    {
        $content = Table::find($id);
        $files[] = public_path() . '/tables/' . $content->thumbnail;
        if ($content->gallery !== null) {
            foreach (json_decode($content->gallery, true) as $item) {
                $files[] = public_path() . '/tables/' . $item;
            }
        }
        $files[] = public_path() . '/qr_codes/' . $content->qrcode;
        File::delete($files);
        $content->delete();
        Session::flash('statuscode', 'error');
        return redirect()->route('admin.tables.index')->with('status', 'Space Deleted');
    }

}