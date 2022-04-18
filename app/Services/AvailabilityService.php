<?php

namespace App\Services;

use App\Http\Requests\Availability\AvailabilityUpdateRequest;
use App\Models\ProductAvailabilities;

class AvailabilityService
{
    public function update(AvailabilityUpdateRequest $request): array
    {
        $productAvailability = ProductAvailabilities::firstOrNew([
            'product_id' => $request->product_id,
            'size' => $request->size
        ]);

        $productAvailability->count = $request->count;
        $productAvailability->save();

        return [
            'message' => 'Success!'
        ];
    }
}
