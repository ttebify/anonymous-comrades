<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use JsonException;

class RegistrationController extends ApiController
{
    public function register(Request $request)
    {
        try {

            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'username' => 'required|string|unique:users|max:255',
                'bio' => 'nullable|string',
                'avatar' => 'nullable|image|max:2048',
                'password' => 'required|string|min:8|confirmed',
                'email' => 'required|string|email|unique:users|max:255',
            ]);

            // Store the avatar if provided
            $avatarPath = null;
            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $avatarPath = $avatar->store('avatars', 'public');
            }

            $user_data = [
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'username' => $validated['username'],
                'bio' => $validated['bio'],
                'avatar' => $avatarPath,
                'password' => Hash::make($validated['password']),
                'email' => $validated['email'],
            ];

            $user = User::create($user_data);

            activity()->log($request['email'].' just registered');

            return $this->respondCreated(['message' => 'Registration was successfull', 'data' => $user]);
        } catch (JsonException $e) {
            logger($e, $e->getTrace());

            return $this->respondError('Failed to create a new account', 400);
        }
    }
}
