<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    public function create(): JsonResponse
    {
        $orderService = new OrderService();
        $orderService->store();

        return response()->json([
            'message' => 'Success!'
        ]);
    }
}
