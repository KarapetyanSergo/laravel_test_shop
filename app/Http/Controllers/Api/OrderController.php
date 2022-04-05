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

        $price = $products->first()->price;
        $cartKey = array_search($products->first()->id, array_column($carts->all(), 'product_id'));

        $query = ProductAvailabilities::where([
            ['product_id', '=', $products[0]->id],
            ['size', '=', $carts[$cartKey]->size]
        ]);

        foreach ($products as $key => $product) {
            if ($key < 1) continue;

            $cartKey = array_search($product->id, array_column($carts->all(), 'product_id'));

            $query = $query->orWhere([
                ['product_id', '=', $product->id],
                ['size', '=', $carts[$cartKey]->size]
            ]);

            $price = $price + $product->price;
        }
        dd($query->decrement('count', 3)->toSql());

        Order::create([
            'user_id' => $user->id,
            'price' => $price,
        ]);


        return response()->json([
            'asd'
        ]);
    }
}
