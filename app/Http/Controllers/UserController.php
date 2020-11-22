<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\View\View;


use Session;
class UserController extends Controller
{
     
    public function index()
    {

        $users = User::paginate(10);
        return view('users.index',compact('users'));

  
        $users = User::orderby('id', 'desc')->paginate(2);
        return view('users.index', compact('users'));

    }

    
    public function create()
    {
       return view('users.create');
    }

    
    public function store(Request $request)
    {
        $this->validate($request,[

          //   'email'    => 'required|email|unique:users', 
          // 'password' => 'required|min:3',
          //  'name'     => 'required|string|min:4',
          //  'phone'    => 'required',
        ]);    

        $user = new User;
        $user->name = $request->input('name');
             if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = \public_path('/users');
            $image->move($destinationPath,$name);
            $user->avatar = $name;
        } 
        
        $user->address     = $request->address;
        $user->email = $request->input('email');
        $user->password = Hash::make($request->password);
        $user->phone = $request->input('phone');
        $user->role = $request->input('role');
        $user->status = $request->input('statue');
      

        $user->save();
        Session::flash('statuscode','success');
        return redirect()->route('admin.users.index')->with('status', 'User Created');

    }

 
   

 
     public function edit($id) {
        $content = User::find($id);
        return view ('users.edit',compact('content'));
    }

    public function update(Request $request, $id) {
        $user = User::find($id);
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->phone    = $request->phone;
        $user->role     = $request->role;
        $user->status     = $request->status;
        $user->address     = $request->address;
        $user->name = $request->input('name');
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = \public_path('/users');
            $image->move($destinationPath,$name);
            $user->avatar = $name;
        } 
        $user->password = Hash::make($request->password);
        $user->save();

        

        Session::flash('statuscode','info');
        return redirect()->route('admin.users.index')->with('status','User Updated');

    }

   
    public function destroy($id)
    {
        User::find($id)->delete();
        Session::flash('statuscode','error');
        return redirect()->route('admin.users.index')->with('status','User Deleted');
    }
}
