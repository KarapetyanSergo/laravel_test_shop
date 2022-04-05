<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Resources\CategoryRecource;
use App\Http\Resources\ProductRecource;
use App\Models\Product;
use App\Models\User;
use App\Services\FilterService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request, FilterService $service): JsonResponse
    {
        $filters = json_decode($request->getContent(), true);

        if (isset($filters['filters'])) {
            $filters = Collection::make(
                json_decode($request->getContent(), true)['filters']
            );

            $response = $service->filtration($filters, new User())->get();
        } else {
            $response = Product::all();
        }

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
