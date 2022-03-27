<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\CartDeleteRequest;
use App\Http\Requests\Cart\CartStoreRequest;
use App\Http\Resources\CartResource;
use App\Models\ProductUser;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(User $user): Response
    {
        $products = Auth::user()->products->all();
        $price = 0;

        foreach ($products as $product) {
            $price = $price + $product->price;
        }

        return response([
            'products'  => $products,
            'price' =>  $price
        ]);
    }

    public function store(CartStoreRequest $request): Product
    {
        $product = Product::find($request->product_id);
        $size = $request->size;

        $product->users()->attach(Auth::user(), ['size' => $size]);

        return $product;
    }

    public function destroy(CartDeleteRequest $request): Product
    {
        $product = Product::find($request->product_id);

        $product->users()->detach(Auth::user());

        return $product;
    }
}
