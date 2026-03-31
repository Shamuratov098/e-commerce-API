<?php

namespace App\Policies;

use App\Models\Reviews;
use App\Models\User;

class ReviewsPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Reviews $review): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Reviews $review): bool
    {
        return $review->user_id === $user->id;
    }

    public function delete(User $user, Reviews $review): bool
    {
        return $review->user_id === $user->id || $user->isAdmin();
    }

    public function restore(User $user, Reviews $review): bool
    {
        return false;
    }

    public function forceDelete(User $user, Reviews $review): bool
    {
        return false;
    }
}
