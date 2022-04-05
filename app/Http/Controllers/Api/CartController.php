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

        return response()->json($response);
    }

    public function store(CartStoreRequest $request)
    {
        $product = Product::find($request->product_id);

        $product->users()->attach(Auth::user(), [
            'size' => $request->size,
            'count' => $request->count
        ]);

        return response()->json([
            'message' => 'Success!'
        ]);
    }

    public function destroy(CartDeleteRequest $request): JsonResponse
    {
        $product = Product::find($request->product_id);

        $product->users()->detach(Auth::user());

        return response()->json([
            'message' => 'Success!'
        ]);
    }

    public function update(CartPutRequest $request): JsonResponse
    {
        $productId = $request->product_id;

        $userProduct = ProductUser::where([
            ['user_id', '=', Auth::user()->id],
            ['product_id', '=', $productId]
        ])->update($request->validated());

        return response()->json([
            'message' => 'Success!'
        ]);
    }
}
