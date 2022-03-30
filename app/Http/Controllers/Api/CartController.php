<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\CartDeleteRequest;
use App\Http\Requests\Cart\CartPutRequest;
use App\Http\Requests\Cart\CartStoreRequest;
use App\Models\Product;
use App\Models\ProductUser;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Auth::user()->products->all();
        $price = 0;

        foreach ($products as $product) {
            $price = $price + $product->price;
        }

        return response()->json([
            'products'  => $products,
            'price' =>  $price
        ]);
    }

    public function store(CartStoreRequest $request): JsonResponse
    {
        $product = Product::find($request->product_id);
        $size = $request->size;

        $product->users()->attach(Auth::user(), ['size' => $size]);

        return response()->json($product);
    }

    public function destroy(int $productId, CartDeleteRequest $request): JsonResponse
    {
        $product = Product::find($productId);

        $product->users()->detach(Auth::user());

        return response()->json($product);
    }

    public function update(int $productId, CartPutRequest $request): JsonResponse
    {
        ProductUser::where([
            ['user_id', '=', Auth::user()->id],
            ['product_id', '=', $productId]
        ])->update($request->validated());

        return response()->json(
          'Success'
        );
    }
}
