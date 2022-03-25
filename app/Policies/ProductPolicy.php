<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function checkMerchant(User $user): bool
    {
        if ($user->type == 'merchant') {
            return true;
        }


        return false;
    }
}
