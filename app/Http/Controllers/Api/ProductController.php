<?php

namespace App\Http\Controllers\Api;

use App\Filters\ProductFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Resources\CategoryRecource;
use App\Http\Resources\ProductRecource;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ProductController extends Controller
{
    public function index(Request $request,  ProductService $service): JsonResponse
    {}
        return response()->json($service->get($request->all()));
    }

    public function store(ProductStoreRequest $request, ProductService $service): JsonResponse
    {
        return response()->json(new ProductRecource($service->post($request->validated())));
    }

    public function show(Product $product): JsonResponse
    {
        return response()->json([
            'product' => new ProductRecource($product),
            'category' => new CategoryRecource($product->category)
        ]);
    }

    public function top(int $count, ProductService $service): JsonResponse
    {
        return response()->json($service->top($count));
    }

    public function destroy(Product $product, ProductService $service): JsonResponse
    {
        $service->delete($product);

        return response()->json($product);
    }
}
