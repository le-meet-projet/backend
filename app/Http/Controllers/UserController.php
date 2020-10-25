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
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $users = User::all();
        echo $users;
        exit();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
       return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
 

        $rules = [
         // 'email'    => 'required|email|unique:users', 
         //  'password' => 'required|min:3',
         //  'name'     => 'required|string|min:4',
         //  'phone'    => 'required',
        ];
 
        $rules = [];
 
        $messages = [
            'email.required'    => trans("email.required"),
            'email.email'       => trans("email.unique"),
            'email.unique'      => trans("name.required"),
            'password.required' => trans("password.required"),
            'password.min'      => trans("password.min"),
            'name.required'     => trans("name.required"),
            'phone.required'    => trans("phone.required"),
        ];

        $request->validate($rules,$messages);

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->password);
        $user->phone = $request->input('phone');
        $user->role = $request->input('role');

        $user->save();
        Session::flash('statuscode','success');
        return redirect()->route('admin.users.index')->with('status', 'User Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
         //  $pagination=User::paginate(2);

         // return view('users.index', compact('pagination'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|Response|View
     */
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
        $user->password = Hash::make($request->password);
        $user->save();
        Session::flash('statuscode','info');
        return redirect()->route('admin.users.index')->with('status','User Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        Session::flash('statuscode','error');
        return redirect()->route('admin.users.index')->with('status','User Deleted');
    }
}
