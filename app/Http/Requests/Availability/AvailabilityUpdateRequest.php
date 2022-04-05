<?php

namespace App\Http\Requests\Availability;

use Illuminate\Foundation\Http\FormRequest;

class AvailabilityUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'product_id' => 'required|exists:products,id',
            'size' => 'required|string',
            'count' => 'required|integer'
        ];
    }
}
