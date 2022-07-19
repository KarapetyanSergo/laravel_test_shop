<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function update(User $user): bool
    {
        return in_array($user->type, [
            $user::TYPE_SUPER_ADMIN,
            $user::TYPE_ADMIN,
            $user::TYPE_CUSTOMER
        ]);
    }
}
