<?php

namespace App\Http\Controllers;

 
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Profiler;
use App\User;
use Session;
use Illuminate\Support\Facades\Hash;
class ProfileController extends Controller
{
    public function index()
    {
        return view('profile');
    }

     

    public function update(Request $request, $id) {
        $user = User::find($id);
        
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = \public_path('/users');
            $image->move($destinationPath,$name);
            $user->avatar = $name;
        } 
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->phone    = $request->phone;
        $user->address     = $request->address;

        $user->password = Hash::make($request->password);
        $user->save();

        

        Session::flash('statuscode','info');
         
         return redirect()->route('admin.profile.index')->with('status','Profile Updated');

    }
}
