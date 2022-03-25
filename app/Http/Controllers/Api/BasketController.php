<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Basket\BasketStoreRequest;
use App\Http\Resources\BasketResource;
use App\Models\Basket;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function index(User $user): Collection
    {
        return Auth::user()->baskets;
    }

    public function store(BasketStoreRequest $request): BasketResource
    {
        $createBasket = Basket::create($request->validated());

        return new BasketResource($createBasket);
    }

    public function destroy(Basket $basket): Basket
    {
        $basket->delete();

        return $basket;
    }
}
