<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function create(User $user): bool
    {
        return $user->type == 'admin';
    }

    public function delete(User $user): bool
    {
        return $user->type == 'admin';
    }
}
