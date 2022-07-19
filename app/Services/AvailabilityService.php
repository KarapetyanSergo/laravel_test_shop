<?php

use App\Models\ProductAvailabilities;

class AvailabilityService
{
    public function update(array $data)
    {
        $productAvailability = ProductAvailabilities::firstOrNew([
            'product_id' => $data['product_id'],
            'size' => $data['size']
        ]);

        $productAvailability->count = $data['count'];
        $productAvailability->save();

        return [
            'message' => 'Success!'
        ];
    }
}