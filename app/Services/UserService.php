<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function updateProfile(User $user, array $data): User
    {
        $user->update($data);

        return $user->fresh();
    }

    public function updatePassword(User $user, array $data): User
    {
        if (! Hash::check($data['old_password'], $user->password)) {
            abort(403, 'Current password is incorrect');
        }

        $user->update(['password' => $data['new_password']]);

        return $user->fresh();
    }
}
