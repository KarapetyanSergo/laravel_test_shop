<?php

namespace App\Services;

use App\Filters\ProductFilter;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    public function get(array $requestData): Collection
    {
        if (isset($requestData['filters'])) {
            $filter = new ProductFilter();
            $response = $filter->handle($requestData['filters'], Product::query())->get();
        } else {
            $response = Product::withCount('orders')->get();
        }

        return $response;
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
