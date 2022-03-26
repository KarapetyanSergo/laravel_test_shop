<?php

namespace App\Policies;

use App\Models\Basket;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BasketPolicy
{
    use HandlesAuthorization;

    public function viewAny (User $user): bool
    {
        if ($user->type == 'customer' || $user->type == 'admin') {
            return true;
        }

        return false;
    }

    public function create (User $user): bool
    {
        if ($user->type == 'customer' || $user->type == 'admin') {
            return true;
        }

        return false;
    }

    public function delete (User $user): bool
    {
        if ($user->type == 'customer' || $user->type == 'admin') {
            return true;
        }

        return false;
    }
}
