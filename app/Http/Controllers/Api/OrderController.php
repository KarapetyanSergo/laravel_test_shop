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
        $create = $orderService->store();

        if ($create) {
            $message = 'Order is processed!';
        } else {
            $message = 'No clearance products!';
        }

        return response()->json([
            'message' => $message
        ]);
    }
}
