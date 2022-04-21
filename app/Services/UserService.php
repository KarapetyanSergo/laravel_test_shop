<?php

namespace App\Services;

use App\Filters\Filters\UserFilter;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    public function get(array $requestData): Collection
    {
        $filter = new UserFilter();
        $filtersData = $requestData['filters'] ?? [];

        return $filter->handle($filtersData, User::query())
            ->get();
    }
}
