<?php

namespace App\Policies;

use App\Models\ProductUser;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CartPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return in_array($user->type, [
            $user::TYPE_SUPER_ADMIN,
            $user::TYPE_ADMIN,
            $user::TYPE_CUSTOMER
        ]);
    }

    public function create(User $user): bool
    {
        return in_array($user->type, [
            $user::TYPE_SUPER_ADMIN,
            $user::TYPE_ADMIN,
            $user::TYPE_CUSTOMER
        ]);
    }

    public function delete(User $user): bool
    {
        return in_array($user->type, [
            $user::TYPE_SUPER_ADMIN,
            $user::TYPE_ADMIN,
            $user::TYPE_CUSTOMER
        ]);
    }

    public function update(User $user): bool
    {
        return in_array($user->type, [
            $user::TYPE_SUPER_ADMIN,
            $user::TYPE_ADMIN,
            $user::TYPE_CUSTOMER
        ]);
    }
}
