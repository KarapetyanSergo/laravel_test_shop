<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductAvailabilities;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        for ($i=0; $i<2000; $i++) {
            $product = Product::create([
                'color' => Arr::random(Product::PRODUCT_COLORS),
                'price' => rand(100, 10000),
                'category_id' => Arr::random(Category::whereDoesntHave('children')->get()->all())->id,
                'brand_id' => Arr::random(Brand::get()->all())->id,
                "created_at" =>  \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]);

            $sizes = ['S', 'M', 'L', 'XS', 'XL', 'XXL'];
            $productAvailabilities = [];

            for ($i=0; $i<rand(1, 6); $i++) {
                $size =  Arr::random($sizes);

                $productAvailabilities[] = [
                    'product_id' => $product->id,
                    'size' => $size,
                    'count' => rand(10, 100),
                    "created_at" =>  \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                ];

                $sizes = array_diff($sizes, [$size]);
            }

            ProductAvailabilities::insert($productAvailabilities);

            $user = Arr::random(User::get()->all());
            $products = Arr::random(Product::get()->all(), rand(1, 5));

            $price = 0;
            foreach ($products as $product) {
                $price = $price + $product->price;
            }

            $order = Order::create([
                'user_id' => $user->id,
                'price' => $price,
                "created_at" =>  \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]);

            $orderProduct = [];
            foreach ($products as $product) {
                $availabilities = $product->availabilities->all();

                $orderProduct[] = [
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'size' => Arr::random($availabilities)->size,
                    'count' => Arr::random($availabilities)->count,
                    "created_at" =>  \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                ];

            }

            OrderProduct::insert($orderProduct);
        }

    }
}
