<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;
use Exception;

class ProfileService
{
    public function updateProfile(User $user, array $data, ?UploadedFile $avatar = null)
    {
        try {
            if ($avatar) {
                // Delete old avatar if exists
                if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                    Storage::disk('public')->delete($user->avatar);
                }
                
                $path = $avatar->store('avatars', 'public');
                $data['avatar'] = $path;
            }

            if (!empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }

            $user->update($data);
            
            return $user;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
