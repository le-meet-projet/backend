<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserApiController extends Controller
{
    /**
     * VALIDATE REQUEST
     * CREATE
     */
    public function register()
    {
        return null;
    }

    /**
     * VALIDATE REQUEST
     * UPDATE PROFILE & AVAtAR
     */
    public function updateInfo()
    {
        return null;
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
