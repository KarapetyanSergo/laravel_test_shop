<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductPutRequest;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Resources\CategoryRecource;
use App\Http\Resources\ProductRecource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return ProductRecource::collection(product::all());
    }

    public function store(ProductStoreRequest $request): ProductRecource
    {
        $createProduct = Product::create($request->validated());

        return new ProductRecource($createProduct);
    }

    public function update(ProductPutRequest $request, Product $product): ProductRecource
    {
        var_dump(Auth::check());

        if (Auth::check()) {
            $request->authorize = true;
        };

        $product->update($request->validated());

        return new ProductRecource($product);
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
