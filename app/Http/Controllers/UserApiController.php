<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserApiController extends Controller
{
    public function index()
    {
        return new JsonResponse(['User' => Auth::user()]);
    }

    /**
     * VALIDATE REQUEST
     * CREATE
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required | string | min:4',
            'email' => 'required | string',
            'password' => 'required | string | min:8'
        ]);
        if ( !$validation ) {
            return new JsonResponse([
                'The data is not valid'
            ]);
        }
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
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
        $user = Auth::user();
        $validation = $request->validate([
            'name' => 'string',
            'email' => 'string',
            'password' => 'string'
        ]);
        if ( !$validation ) {
            return new JsonResponse([
                'The data is not valid'
            ]);
        }
        $hashedPassword = $request->password ? Hash::make($request->password) : $user['password'];
        $data = [
            'name' => $request->name ?? $user['name'],
            'email' => $request->email ?? $user['email'],
            'password' => $hashedPassword,
        ];

        $user->update($data);
        return new JsonResponse(['message' => 'You infos was updated with successfully !']);
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

    public function logout()
    {
        return null;
    }
}
