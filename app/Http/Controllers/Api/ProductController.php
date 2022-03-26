<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Resources\CategoryRecource;
use App\Http\Resources\ProductRecource;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductController extends Controller
{
    public function index(): Collection
    {
        return Product::all();
    }

    public function store(ProductStoreRequest $request): ProductRecource
    {
        $createProduct = Product::create($request->validated());

        return new ProductRecource($createProduct);
    }

    public function show(Product $product): object
    {
        return (object)[
            'product' => new ProductRecource($product),
            'category' => new CategoryRecource($product->category)
        ];
    }

    public function destroy(Product $product): Product
    {
        $product->delete();

        return $product;
    }
}
