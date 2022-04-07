<?php

namespace App\Services;

use App\Filters\UserFilter;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class UserService
{
    public function get(array $requestData): Builder
    {
        $filter = new UserFilter();
        $filtersData = $requestData['filters'] ?? [];

        return $filter->handle($filtersData, Product::query());
    }
}
