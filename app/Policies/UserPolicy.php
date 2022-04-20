<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function show(User $user): bool
    {
        return in_array($user->type, [
            User::TYPE_SUPER_ADMIN,
            User::TYPE_ADMIN,
        ]);
    }

    public function delete(User $user): bool
    {
        return $user->type == User::TYPE_SUPER_ADMIN;
    }
}
