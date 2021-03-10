<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
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
            'email' => ' string | email | max:255 | unique:users',
            'password' => 'string | min:6 ',
            'phone' => 'required | string | min:10 | max:15 | unique:users',
        ]);

        if ($validator->fails())
        {
            $api = [
                'state' => false,
                'message' =>  $validator->errors()->all()[0] ,
                'data' => ''
            ];
            return response($api, 200);
        }

        $request['password'] = Hash::make($request['password']);

        $request['avatar'] = 'default-user-avatar.png';
  
        $saved = User::create($request->toArray());

        if($saved){
            $api = [
                'state' => true,
                'message' => '',
                'data' => '',
            ];
            return response($api,200);
        }

        $api = [
            'state' => false,
            'message' => 'something went wrong',
            'data' => '',
        ];
        return response($api,422);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function login(Request $request): Response
    {

        $logins = $request->validate([
            'phone' => 'required | string | min:8 | max:15',
        ]);

        $phone = $request['phone'];
        
        $user = User::where(['phone' => $phone])->first();

        if(!$user){
            $api = [
                'success' => false,
                'message' => 'المعلومات خاطئة ! المرجوا المحاولة من جديد',
            ];
            return response($api);
        }

        Auth::login($user);

        $token = Auth::user()->createToken('authToken')->accessToken;

        $api = [
            'success' => true,
            'token' => $token,
            'user' => $user
        ];

        return response($api, 200);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function logout (Request $request): Response
    {
        $token = $request->user()->token();
        $token->revoke();


        $api = [
            'state' => true,
            'message' => '',
            'data' => '',
        ];
        return response($api,200);

    }


    public function check(){
        if (  \Auth::guard('api')->check()) {

           return response(['authenticated' => true ]);
        }
        return response(['authenticated' => false ]);
    }
}
