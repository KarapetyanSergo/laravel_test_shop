<?php

namespace App\Services;

use App\Filters\ProductFilter;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    public function get(array $requestData): Collection
    {
        return (isset($requestData['filters'])) ? (new ProductFilter())->handle($requestData['filters'], Product::query())->get() : Product::all();
    }

    public function post(array $requestData): Product
    {
        return Product::create($requestData);
    }

    public function delete(Product $product): array
    {
        $product->delete();

        return [
            'Product deleted succesfully.'
        ];
    }
}
