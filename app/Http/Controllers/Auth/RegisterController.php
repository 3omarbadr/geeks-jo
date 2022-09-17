<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    use ApiResponser;

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $accessToken = $user->createToken('Geeks Token')->accessToken;

        return $this->success(['user' => $user, 'access_token' => $accessToken], 200);
    }
}
