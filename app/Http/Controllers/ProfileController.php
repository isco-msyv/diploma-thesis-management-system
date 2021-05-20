<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdate;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit');
    }

    public function update(ProfileUpdate $request)
    {
        $validated = $request->validated();

        $profile = auth()->user();

        if ($validated['password'] != null) {
            if (!Hash::check($validated['password_old'], $profile->getAuthPassword())) {
                return back()->with(['toast-type' => 'error', 'message' => 'Current password is wrong!']);
            }

            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $profile->update($validated);

        auth()->login($profile);

        return back()->with(['toast-type' => 'success', 'message' => 'Profile updated!']);
    }
}


