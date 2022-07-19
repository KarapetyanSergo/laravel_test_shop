<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\CartDeleteRequest;
use App\Http\Requests\Cart\CartPutRequest;
use App\Http\Requests\Cart\CartStoreRequest;
use CartService;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    public function index(CartService $service): JsonResponse
    {
        return response()->json($this->getDataResponse($service->get()));
    }

    public function store(CartStoreRequest $request, CartService $service): JsonResponse
    {
        return response()->json($this->getDataResponse($service->create($request->validated())));
    }

    public function destroy(CartDeleteRequest $request, CartService $service): JsonResponse
    {
        return response()->json($this->getDataResponse($service->delete($request->validated())));
    }

    public function update(CartPutRequest $request, CartService $service): JsonResponse
    {
        return response()->json($this->getDataResponse($service->update($request->validated())));
    }
}
