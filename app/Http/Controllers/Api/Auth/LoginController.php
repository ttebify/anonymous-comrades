<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JsonException;

class LoginController extends ApiController
{
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            if (! Auth::attempt($credentials)) {
                return $this->respondError('Invalid credentials', 401);
            }

            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            activity()->log($user->email.' just logged in');

            return $this->respond([
                'user' => $user,
                'token' => $token,
            ]);

        } catch (JsonException $e) {
            logger($e, $e->getTrace());

            return $this->respondError('Failed to login', 400);
        }
    }
}
