<?php

namespace App\Services;

use App\Models\Order;
use App\Models\ProductAvailabilities;
use App\Models\ProductUser;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function store(): bool
    {
        return DB::transaction(function () {

            $user = Auth::user();
            $carts = ProductUser::where('user_id', $user->id)->get();

            if (!$carts->all()) {
                return false;
            }

            $products = $user->products()->get();

            $ordersData = $this->reductionNumberOfProducts($products, $carts);

            if (!$ordersData['orders']) {
                return false;
            }

            $this->createOrder($user, $ordersData);

            $user->products()->detach();

            return true;
        });
    }

    function createOrder(Authenticatable $user, array $ordersData): void
    {
        $order = Order::create([
            'user_id' => $user->id,
            'price' => $ordersData['price'],
        ]);

        $orderId = $order->id;

        for ($i = 0; $i < count($ordersData['orders']); $i++) {
            $ordersData['orders'][$i]['order_id'] = $orderId;
        }

        $order->products()->attach($ordersData['orders']);
    }

    private function reductionNumberOfProducts(Collection $products, Collection $carts): array
    {
        $price = 0;
        $productOrders = [];

        foreach ($products as $product) {
            $cartIndex = array_search($product->id, array_column($carts->all(), 'product_id'));

            $cartProductCount = $carts[$cartIndex]->count;
            $cartProductSize = $carts[$cartIndex]->size;

            $productAvailability = ProductAvailabilities::firstOrNew([
                ['product_id', '=', $product->id],
                ['size', '=', $cartProductSize]
            ]);

            if ($productAvailability->count >= $cartProductCount) {
                $productAvailability->count = $productAvailability->count - $cartProductCount;
                $price = $price + $product->price;

                $productOrders[] = [
                    'product_id' => $product->id,
                    'size' => $cartProductSize,
                    'count' => $cartProductCount
                ];
            } else {
                // send notification to user
            }

            $productAvailability->save();
        }

        return [
            'orders' => $productOrders,
            'price' => $price
        ];
    }
}
