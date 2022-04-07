<?php

namespace App\Http\Controllers\Api;

use App\Filters\ProductFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Resources\CategoryRecource;
use App\Http\Resources\ProductRecource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request, ProductFilter $filter): JsonResponse
    {
        $response = $filter->filtration($request->all(), Product::query())
            ->where('category_id', '!=', 3)
            ->get();

        return response()->json($response);
    }

    public function store(ProductStoreRequest $request): JsonResponse
    {
        $createProduct = Product::create($request->validated());

        return response()->json(new ProductRecource($createProduct));
    }

    public function show(Product $product): JsonResponse
    {
        return response()->json([
            'product' => new ProductRecource($product),
            'category' => new CategoryRecource($product->category)
        ]);
    }

    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json($product);
    }
}
