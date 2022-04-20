<?php

namespace App\Http\Requests\Availability;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AvailabilityUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'product_id' => 'required|exists:products,id',
            'size' => [
                'required',
                'string',
                Rule::in(Product::PRODUCT_SIZES),
            ],
            'count' => 'required|integer'
        ];
    }
}
