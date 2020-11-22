<?php

namespace App\Http\Controllers;

 
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Profiler;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile');
    }

     

    public function update(Request $request, $id) {
        $user = User::find($id);
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->phone    = $request->phone;
         
        $user->address     = $request->address;
        //$user->password = Hash::make($request->password);
        $user->save();

        

        
         
         return view('profile') ;

    }
}
