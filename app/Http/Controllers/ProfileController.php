<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProfileService;
use Exception;

class ProfileController extends Controller
{
    public function update(Request $request, ProfileService $profileService)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'password' => 'nullable|string|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $profileService->updateProfile(
                auth()->user(), 
                $request->only('name', 'email', 'password'), 
                $request->file('avatar')
            );
            return redirect()->back()->with('success', 'Profile updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error updating profile: ' . $e->getMessage());
        }
    }
}
