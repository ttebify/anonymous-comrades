<?php

namespace App\Http\Controllers\Api\Auth;

use App\Comrades\Api\UserApi;
use App\Http\Controllers\ApiController;
use App\Library\NotificationHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use JsonException;

class RegistrationsController extends ApiController
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

            $verification_code = rand(10000, 99999);
            $user_data = [
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'username' => $validated['username'],
                'bio' => $validated['bio'],
                'avatar' => $avatarPath,
                'password' => Hash::make($validated['password']),
                'email' => $validated['email'],
            ];

            // send confirmation
            $templateId = 30089867;
            $templateModelArray = [
                'product_url' => env('FRONTEND_URL'),
                'company_name' => env('APP_NAME'),
                'company_address' => '',
                'product_name' => env('APP_NAME'),
                'verification_code' => $verification_code,
            ];
            $payload = [
                'from' => 'Anonymous Comrade <support@anonymouscomrade.com>',
                'recipients' => [$user_data['email']],
                'templateId' => $templateId,
                'templateModelArray' => [$templateModelArray],
                'messageStream' => app()->environment(['local', 'staging', 'develop']) ? 'development' : 'outbound',
            ];

            NotificationHandler::send($payload);

            $user_data['verification_code'] = encrypt($verification_code);
            $user_data['verification_code_expires_at'] = now()->addMinutes(config('chat.verification_pin_expiration'));

            $temp_user = UserApi::createNewUser($user_data);

            activity()->log($request['email'].' just registered');

            return $this->respondCreated(['message' => 'Registration was successfull, Check your email to continue', 'data' => $temp_user]);
        } catch (JsonException $e) {
            logger($e, $e->getTrace());

            return $this->respondError('Failed to create a new account', 400);
        }
    }
}
