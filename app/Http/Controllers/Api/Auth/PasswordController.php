<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use App\Models\User;
use Illuminate\Http\Request;

class PasswordController extends ApiController
{
    public function forgotPassword(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|exists:users|max:255',
        ]);

        $user = User::where('email', $validated['email'])->firstOrFail();

        // TODO: handle logic to generate token and send email

        $reponse = ['message' => 'Check your email for password reset instructions'];

        return $this->respond($reponse);
    }

    public function resetPassword(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|exists:users|max:255',
            'token' => 'required|max:6',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::where('email', $validated['email'])->firstOrFail();

        // TODO: handle logic to verify token, reset password and invlaidate password reset token
        $user->password = $validated['password'];
        $user->save();
        $reponse = ['message' => 'Password reset successfully'];

        return $this->respond($reponse);
    }
}
