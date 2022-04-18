<?php

namespace App\Services;

use App\Http\Requests\Cart\CartDeleteRequest;
use App\Http\Requests\Cart\CartPutRequest;
use App\Http\Requests\Cart\CartStoreRequest;
use App\Models\Product;
use App\Models\ProductUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CartService
{
    public function index(): array
    {
        $user = Auth::user();
        $carts = ProductUser::where('user_id', $user->id)->get()->all();
        $products = $user->products()->get();
        $price = 0;
        $response = [];

        foreach ($carts as $cart) {
            $key = array_search($cart->product_id, array_column($products->all(), 'id'));
            $price = $price + ($cart->count * $products[$key]->price);

            $response[] = [
                $products[$key],
                ['SubTotal' => $price]
            ];

        }

        return $response;
    }

    public function store(CartStoreRequest $request): array
    {
        $product = Product::find($request->product_id);

        $product->users()->attach(Auth::user(), [
            'size' => $request->size,
            'count' => $request->count
        ]);

        return [
            'message' => 'Success!'
        ];
    }

    public function destroy(CartDeleteRequest $request): array
    {
        $product = Product::find($request->product_id);

        $product->users()->detach(Auth::user());

        return [
            'message' => 'Success!'
        ];
    }

    public function update(CartPutRequest $request): array
    {
        $productId = $request->product_id;

        ProductUser::where('user_id', Auth::user()->id)
            ->where('product_id', $productId)
            ->update($request->validated());

        return [
            'message' => 'Success!'
        ];
    }
}
