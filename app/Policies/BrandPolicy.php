<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BrandPolicy
{
    use HandlesAuthorization;

    public function create (User $user): bool
    {
        if ($user->type == 'merchant' || $user->type == 'admin') {
            return true;
        }

        return false;
    }

    public function delete (User $user): bool
    {
        if ($user->type == 'merchant' || $user->type == 'admin') {
            return true;
        }

        return false;
    }

    public function updateStatus (User $user): bool
    {
        if($user->type == 'admin') {
            return true;
        }

        return false;
    }
}
