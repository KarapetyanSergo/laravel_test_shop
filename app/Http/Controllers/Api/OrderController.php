<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ProductAvailabilities;
use App\Models\ProductUser;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function create(): JsonResponse
    {
        $user = Auth::user();
        $carts = ProductUser::where('user_id', $user->id)->get();

        $builder = $user->products();
        $products = $builder->get();
        $price = 0;
        $productOrders = [];
        $response = [];

        foreach ($products as $product) {
            $productId = $product->id;
            $cartIndex = array_search($productId, array_column($carts->all(), 'product_id'));
            $cartProductCount = $carts[$cartIndex]->count;
            $cartProductSize = $carts[$cartIndex]->size;

            $productAvailability = ProductAvailabilities::firstOrNew([
                ['product_id', '=', $productId],
                ['size', '=', $cartProductSize]
            ]);

            if ($productAvailability->count >= $cartProductCount) {
                $productAvailability->count = $productAvailability->count - $cartProductCount;

                $price = $price + $product->price;
                $response['message'][] = 'You bought ' . $cartProductCount . ' products with id = ' . $productId;
                var_dump('asd');
                $productOrders[] = [
                    'product_id' => $productId,
                    'size' => $cartProductSize,
                    'count' => $cartProductCount
                ];
            } else {
                $response['message'][] = 'There are not so many products with id = ' . $productId;
            }

            $productAvailability->save();
        }

        if ($price > 0) {
            $order = Order::create([
                'user_id' => $user->id,
                'price' => $price,
            ]);

            $orderId = $order->get()->first()->id;

            for ($i=0; $i<count($productOrders); $i++) {
                $productOrders[$i]['order_id'] = $orderId;
            }

            $order->products()->attach($productOrders);

            $response['price'] = $price;
        }

        return response()->json($response);
    }
}
