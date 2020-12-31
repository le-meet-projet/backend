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
            'email' => 'required | string | email | max:255 | unique:users',
            'password' => 'required | string | min:6 | confirmed',
            'phone' => 'required | string | min:10 | max:15 | unique:users',
        ]);

        if ($validator->fails())
        {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $request['password'] = Hash::make($request['password']);
        User::create($request->toArray());
        $response = ['message' => 'The user was created with success'];
        return response($response, 200);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function login(Request $request): Response
    {
        $logins = $request->validate([
            'phone' => 'required | string | min:8 | max:15',
            'password' => 'required | string ',
        ]);

        $password = $request['password'];
        $phone = $request['phone'];

        $user = User::where(['phone' => $phone])->first();

        $check = false;
        if($user){
            $check = Hash::check($password, $user->password);
        }

        if($check == false){
 
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
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }
}
