<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function create(User $user): bool
    {
        return in_array($user->type, [
            $user::TYPE_SUPER_ADMIN,
            $user::TYPE_ADMIN,
            $user::TYPE_MERCHANT
        ]);
    }

    public function delete(User $user): bool
    {
        return in_array($user->type, [
            $user::TYPE_SUPER_ADMIN,
            $user::TYPE_ADMIN,
            $user::TYPE_MERCHANT
        ]);
    }
}
