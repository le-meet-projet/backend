<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ApiAuthController extends Controller
{

    /**
     * @param Request $request
     * @return Response
     */
    public function register(Request $request): Response
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required | string | max:255',
            'email' => ' required | string | email | max:255 | unique:users',
            'password' => 'string | min:6 ',
            'phone' => 'required | string | min:10 | max:15 | unique:users',
        ]);

        if ($validator->fails())
        {
            return response()->error(400, $validator->errors()->all()[0]);
        }

        $request['password'] = Hash::make($request['password']);

        $request['avatar'] = 'default-user-avatar.png';
  
        $saved = User::create($request->toArray());

        if($saved){
            return response()->success('User registered successfully');
        }

        return response()->error(400, 'Something went wrong');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function login(Request $request): Response
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required | string | min:8 | max:15',
        ]);

        if ($validator->fails())
        {
            return response()->error(400, $validator->errors()->all()[0]);
        }

    //    dd('mdmdmdd');
        $phone = $request['phone'];
        
        $user = User::where(['phone' => $phone])->first();
        if(!$user){
            return response()->error(401, 'المعلومات خاطئة ! المرجوا المحاولة من جديد');
        }

        Auth::login($user);

        $token = Auth::user()->createToken('le meet')->accessToken;

        $data = [
            'token' => $token,
            'user' => $user
        ];
        
        return response()->success('User logged in successfully', $data);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function logout (Request $request): Response
    {
        $token = $request->user()->token();
        $token->revoke();

        return response()->success('User logged out successfully');
    }


    public function check(){
        return response()->data(['authenticated' => \Auth::guard('api')->check()]);
    }
}
