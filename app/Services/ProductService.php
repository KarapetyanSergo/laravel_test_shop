<?php

namespace App\Services;

use App\Filters\ProductFilter;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    public function get(array $requestData): Collection
    {
        $filter = new ProductFilter();
        $filtersData = $requestData['filters'] ?? [];

        return $filter->handle($filtersData, Product::query())->get();
    }

    public function post(array $requestData): Product
    {
        return Product::create($requestData);
    }

    public function delete(Product $product): Product
    {
        $product->delete();

        return $product;
    }
}
