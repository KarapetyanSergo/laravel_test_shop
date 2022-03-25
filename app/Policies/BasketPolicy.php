<?php

namespace App\Policies;

use App\Models\Basket;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BasketPolicy
{
    use HandlesAuthorization;

    public function checkCustomer(User $user): bool
    {
        if ($user->type == 'customer') {
            return true;
        }

        return false;
    }
}
