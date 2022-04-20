<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function create(User $user): bool
    {
        return in_array($user->type, [
            User::TYPE_SUPER_ADMIN,
            User::TYPE_ADMIN,
        ]);
    }

    public function delete(User $user): bool
    {
        return in_array($user->type, [
            User::TYPE_SUPER_ADMIN,
            User::TYPE_ADMIN,
        ]);
    }
}
