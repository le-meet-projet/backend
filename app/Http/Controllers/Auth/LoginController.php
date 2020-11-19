<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->flush(); // this method should be called after we ensure that there is no logged in guards left
        $request->session()->regenerate(); //same 
        return redirect('/');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }





       
    public function login(Request $request) {
      
        $email    = $request->email;
        $password = $request->password;
        
        $this->validate($request, [
            'email'           => 'required|max:255|email',
            'password'        => 'required|min:4',
        ]);
       
  
          if (\Auth::guard()->attempt(['role'=>'admin', 'email' => $email, 'password' => $password], $request->get('remember'))) {
              return redirect('/dashboard');
          }
    
          return back()->withInput($request->only('email', 'remember'))->with('error', 'wrong credentials!');
  
  
      }









}
