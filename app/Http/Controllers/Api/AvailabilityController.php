<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Availability\AvailabilityUpdateRequest;
use App\Models\ProductAvailabilities;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    public function update(AvailabilityUpdateRequest $request)
    {
        $productAvailability = ProductAvailabilities::firstOrNew
        (['product_id' => $request->product_id, 'size' => $request->size]);

        $productAvailability->count = $request->count;
        $productAvailability->save();

        return response()->json([
            'message' => 'Success!'
        ]);
    }
}
