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
        if ($user->type == 'merchant'  || $user->type == 'admin') {
            return true;
        }

        return false;
    }

    public function delete(User $user): bool
    {
        if ($user->type == 'merchant'  || $user->type == 'admin') {
            return true;
        }

        return false;
    }
}
