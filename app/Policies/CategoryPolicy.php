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
            $user::TYPE_SUPER_ADMIN,
            $user::TYPE_ADMIN,
        ]);
    }

    public function delete(User $user): bool
    {
        return in_array($user->type, [
            $user::TYPE_SUPER_ADMIN,
            $user::TYPE_ADMIN,
        ]);
    }
}
