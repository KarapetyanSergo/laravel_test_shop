<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Availability\AvailabilityUpdateRequest;
use AvailabilityService;

class AvailabilityController extends Controller
{
    public function update(AvailabilityUpdateRequest $request, AvailabilityService $service)
    {
        return response()->json($this->getDataResponse($service->update($request->validated())));
    }
}
