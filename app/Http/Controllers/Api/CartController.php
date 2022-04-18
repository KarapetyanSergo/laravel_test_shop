<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\CartDeleteRequest;
use App\Http\Requests\Cart\CartPutRequest;
use App\Http\Requests\Cart\CartStoreRequest;
use App\Models\Product;
use App\Models\ProductUser;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(CartService $service): JsonResponse
    {
        return response()->json($service->index());
    }

    public function store(CartStoreRequest $request, CartService $service): JsonResponse
    {
        return response()->json($service->store($request));
    }

    public function destroy(CartDeleteRequest $request, CartService $service): JsonResponse
    {
        return response()->json($service->destroy($request));
    }

    public function update(CartPutRequest $request, CartService $service): JsonResponse
    {
        return response()->json($service->update($request));
    }
}
