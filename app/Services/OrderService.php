<?php

namespace App\Services;

use App\Models\Order;
use App\Models\ProductAvailabilities;
use App\Models\ProductUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class OrderService
{
    public function store(): bool
    {
        $user = Auth::user();
        $carts = ProductUser::where('user_id', $user->id)->get();

        if (!$carts->all()) {
            return false;
        }

        $builder = $user->products();
        $products = $builder->get();

        $ordersData = $this->reductionNumberOfProducts($products, $carts);
        $this->createOrder($user->id, $ordersData);

        $builder->detach();

        return true;
    }

    private function reductionNumberOfProducts(Collection $products, Collection $carts): array
    {
        $price = 0;
        $productOrders = [];

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

                $productOrders[] = [
                    'product_id' => $productId,
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

    private function createOrder(int $userId, array $ordersData): void
    {
        $orders = $ordersData['orders'];
        $price = $ordersData['price'];

        if ($orders) {
            $order = Order::create([
                'user_id' => $userId,
                'price' => $price,
            ]);

            $orderId = $order->get()->first()->id;

            for ($i = 0; $i < count($orders); $i++) {
                $orders[$i]['order_id'] = $orderId;
            }

            $order->products()->attach($orders);
        }
    }
}
