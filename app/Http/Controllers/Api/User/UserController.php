<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\ApiController;
use App\Models\User;
use App\Models\UserSettings;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

            return $this->respondError('Failed to update profile', Response::HTTP_BAD_REQUEST);
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

    public function getSettings(Request $request)
    {
        $user = $request->user();
        $settings = $user->userSettings;

        if (count($settings) === 0) {
            $settings = UserSettings::SETTINGS;
        }

        return $this->respond(['data' => $settings]);
    }

    public function updateSettings(Request $request)
    {
        try {
            $user = $request->user();

            $request->validate([
                'settings' => 'required|array',
                'settings.*.name' => 'required|string|in:'.implode(',', array_keys(UserSettings::SETTINGS)),
                'settings.*.value' => 'required',
            ]);

            $knownSettings = array_keys(UserSettings::SETTINGS);
            $filteredSettings = collect($request->settings)->filter(function ($setting) use ($knownSettings) {
                return in_array($setting['name'], $knownSettings);
            });

            foreach ($filteredSettings as $setting) {
                UserSettings::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'name' => $setting['name'],
                    ],
                    ['value' => json_encode($setting['value'])]
                );
            }

            return $this->respond(['message' => 'Settings updated successfully']);
        } catch (JsonException $e) {
            logger($e, $e->getTrace());

            return $this->respondError('Failed to update settings', Response::HTTP_BAD_REQUEST);
        }
    }
}
