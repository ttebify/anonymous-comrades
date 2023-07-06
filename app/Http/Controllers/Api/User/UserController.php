<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\ApiController;
use App\Models\User;
use App\Models\UserSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use JsonException;

class UserController extends ApiController
{
    public function getCurrentUser()
    {
        $user = Auth::user();

        return $this->respond(['data' => $user]);
    }

    public function updateProfile(Request $request)
    {
        try {
            $user = $request->user();

            $validatedData = $request->validate([
                'first_name' => 'string|max:255',
                'last_name' => 'string|max:255',
                'bio' => 'nullable|string',
            ]);

            $user->update($validatedData);

            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');

                if ($user->avatar) {
                    Storage::disk('public')->delete($user->avatar);
                }

                $avatarPath = $avatar->store('avatars', 'public');
                $user->avatar = $avatarPath;
                $user->save();
            }

            activity()->log($user->email.' updated their profile');

            return $this->respond(['message' => 'Profile updated successfully', 'data' => $user]);
        } catch (ValidationException $e) {
            throw $e;
        } catch (JsonException $e) {
            logger($e, $e->getTrace());

            return $this->respondError('Failed to update profile', 400);
        }
    }

    public function getUserProfile(string $uuid)
    {
        $user = User::find($uuid);
        if (! $user) {
            return $this->respondNotFound('User not found');
        }

        return $this->respond([
            'data' => $user,
        ]);
    }

    public function getSettings()
    {

        $user = Auth::user();

        $settings = UserSettings::where('user_id', $user->id)->get();

        return response()->json(['data' => $settings]);
    }

    public function updateSettings(Request $request)
    {

        $user = Auth::user();

        $request->validate([
            'settings' => 'required|array',
            'settings.*.name' => 'required|string',
            'settings.*.value' => 'required',
        ]);

        foreach ($request->settings as $setting) {
            UserSettings::updateOrCreate([
                'user_id' => $user->id,
                'name' => $setting['name']],
                ['value' => json_encode($setting['value'])]
            );
        }

        return response()->json(['message' => 'Settings updated successfully']);
    }
}
