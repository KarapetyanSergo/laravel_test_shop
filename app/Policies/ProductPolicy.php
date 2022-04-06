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
        return in_array($user->type, ['superadmin', 'admin', 'merchant']);
    }

    public function delete(User $user): bool
    {
        return in_array($user->type, ['superadmin', 'admin', 'merchant']);
    }
}
