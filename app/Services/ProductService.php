<?php

namespace App\Services;

use App\Filters\ProductFilter;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class ProductService
{
    public function get(array $requestData): Builder
    {
        $filter = new ProductFilter();
        $filtersData = $requestData['filters'] ?? [];

        return $filter->handle($filtersData, Product::query());
    }

    public function post(array $requestData)
    {
        return Product::create($requestData);
    }

    public function delete(array $requestData)
    {

    }
}
