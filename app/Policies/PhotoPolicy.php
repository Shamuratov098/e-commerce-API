<?php

namespace App\Policies;

use App\Models\Photo;
use App\Models\User;

class PhotoPolicy
{
    public function viewAny(User $user): bool
    {
        return false;
    }

    public function view(User $user, Photo $photo): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, Photo $photo): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, Photo $photo): bool
    {
        return $user->isAdmin();
    }

    public function restore(User $user, Photo $photo): bool
    {
        return false;
    }

    public function forceDelete(User $user, Photo $photo): bool
    {
        return false;
    }
}
