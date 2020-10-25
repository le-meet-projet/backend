<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserApiController extends Controller
{
    private function validateRequest(Request $request, string $action = 'register')
    {
        $rules = [];
        $messages = [];
        if ( 'register' === strtolower($action) ) {
            $rules = [
                'email'    => 'required|email|unique:users',
                'password' => 'required|min:3',
                'name'     => 'required|string|min:4',
                'phone'    => 'required',
            ];

            $messages = [
                'email.required'    => trans("email.required"),
                'email.email'       => trans("email.unique"),
                'email.unique'      => trans("email.unique"),
                'password.required' => trans("password.required"),
                'password.min'      => trans("password.min"),
                'name.required'     => trans("name.required"),
                'phone.required'    => trans("phone.required"),
            ];

        }
        else {
            $rules = [
                'email'    => 'required|email|unique:users',
                'password' => 'required|min:3',
                'name'     => 'string|min:4',
            ];

            $messages = [
                'email.required'    => trans("email.required"),
                'email.email'       => trans("email.email"),
                'email.unique'      => trans("email.unique"),
                'password.min'      => trans("password.min"),
            ];
        }
        $request->validate($rules, $messages);
    }

    /**
     * CHECK THE PASSWORDS ARE UNIQUE
     * LOGIN
     * @param Request $request
     * @return Response
     */
    public function login(Request $request)
    {
        $login = $request->validate([
            'email' => 'required | string',
            'password' => 'required | string',
        ]);

        if ( !Auth::attempt( $login ) ) {
            return response([
                'message' => 'Invalid credentials'
            ], 403);
        }

        $accessToken = Auth::user()->createToken('auth')->accessToken;

        return response([
            'message' => 'success',
            'accessToken' => $accessToken
        ]);
    }

    public function index()
    {
        return new JsonResponse(['User' => Auth::user()]);
    }

    /**
     * VALIDATE REQUEST
     * CREATE NEW USER
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        $this->validateRequest($request);
        $data = [
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'phone'    => $request->phone,
        ];

        User::create($data);
        return new JsonResponse(['message' => 'You are registred']);
    }

    /**
     * VALIDATE REQUEST
     * UPDATE PROFILE & AVAtAR
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        $this->validateRequest($request, 'update');
        $user = Auth::user();
        $hashedPassword = $request->password ? Hash::make($request->password) : $user['password'];
        $data = [
            'name'     => $request->name ?? $user['name'],
            'email'    => $request->email ?? $user['email'],
            'password' => $hashedPassword,
            'phone'    => $user['phone'],
        ];

        $user->update($data);
        return new JsonResponse(['message' => 'You infos was updated with successfully !']);
    }


    public function logout()
    {
        return null;
    }
}
