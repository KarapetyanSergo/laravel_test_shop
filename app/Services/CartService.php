<?php

use App\Models\Product;
use App\Models\ProductUser;
use Illuminate\Support\Facades\Auth;

class CartService
{
    public function get(): array
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

    public function create(array $data): array
    {
        $product = Product::find($data['product_id']);

        $product->users()->attach(Auth::user(), [
            'size' => $data['size'],
            'count' => $data['count']
        ]);

        return [
            'message' => 'Success!'
        ];
    }

    public function delete(array $data): array
    {
        $product = Product::find($data['product_id']);

        $product->users()->detach(Auth::user());

        return [
            'message' => 'Success!'
        ];
    }

    public function update(array $data): array
    {
        $productId = $data['product_id'];

        ProductUser::where('user_id', Auth::user()->id)
            ->where('product_id', $productId)
            ->update($data);

        return [
            'message' => 'Success!'
        ];
    }
}