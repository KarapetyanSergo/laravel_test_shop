<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Availability\AvailabilityUpdateRequest;
use App\Models\ProductAvailabilities;
use App\Services\AvailabilityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    public function update(AvailabilityUpdateRequest $request, AvailabilityService $service): JsonResponse
    {
        return response()->json($service->update($request));
    }
}
