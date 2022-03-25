<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function checkAdmin(User $user): bool
    {
        if ($user->type == 'admin') {
            return true;
        }

        return false;
    }
}
