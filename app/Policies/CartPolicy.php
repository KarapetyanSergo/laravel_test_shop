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
        return in_array($user->type, ['superadmin', 'admin', 'customer']);
    }

    public function create(User $user): bool
    {
        return in_array($user->type, ['superadmin', 'admin', 'customer']);
    }

    public function delete(User $user): bool
    {
        return in_array($user->type, ['superadmin', 'admin', 'customer']);
    }

    public function update(User $user): bool
    {
        return in_array($user->type, ['superadmin', 'admin', 'customer']);
    }
}
