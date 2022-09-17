<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Traits\ApiResponser;
use App\Models\User;

class LoginController extends Controller
{
    use ApiResponser;
    public function login(LoginRequest $request)
    {
        if(!auth()->attempt($request->validated()))
        {
           return $this->error('UnAuthorized Access',401);
        }

        $accessToken = auth()->user()->createToken('Geeks Token')->accessToken;
            
        return $this->success(['user' => auth()->user(),'access_token' => $accessToken], 'You Are Logged In! ;' );

    }
}
