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
            User::TYPE_SUPER_ADMIN,
            User::TYPE_ADMIN,
            User::TYPE_CUSTOMER
        ]);
    }

    public function create(User $user): bool
    {
        return in_array($user->type, [
            User::TYPE_SUPER_ADMIN,
            User::TYPE_ADMIN,
            User::TYPE_CUSTOMER
        ]);
    }

    public function delete(User $user): bool
    {
        return in_array($user->type, [
            User::TYPE_SUPER_ADMIN,
            User::TYPE_ADMIN,
            User::TYPE_CUSTOMER
        ]);
    }

    public function update(User $user): bool
    {
        return in_array($user->type, [
            User::TYPE_SUPER_ADMIN,
            User::TYPE_ADMIN,
            User::TYPE_CUSTOMER
        ]);
    }
}
