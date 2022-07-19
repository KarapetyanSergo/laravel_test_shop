<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Resources\ProductRecource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request,  ProductService $service): JsonResponse
    {
        return response()->json($this->getDataResponse($service->get($request->all())));
    }

    public function store(ProductStoreRequest $request, ProductService $service): JsonResponse
    {
        $response = new ProductRecource($service->post($request->validated()));

        return response()->json($response);
    }

    public function show(Product $product): JsonResponse
    {
        $response = $product->with('category');

        return response()->json($this->getDataResponse($response));
    }

    public function destroy(Product $product, ProductService $service): JsonResponse
    {
        return response()->json($this->getDataResponse($service->delete($product)));
    }
}
