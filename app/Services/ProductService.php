<?php

namespace App\Services;

use App\Filters\Filters\ProductFilter;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    public function get(array $requestData): Collection
    {
        if (isset($requestData['filters'])) {
            $filter = new ProductFilter();
            $query = $filter->handle($requestData['filters'], Product::query());

        } else {
            $query = Product::withCount('orders');
        }

        return $query->get();
    }

    public function top($count): Collection
    {
        return Product::withCount('orders')
            ->orderBy('orders_count', 'desc')
            ->limit($count)->get();
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
