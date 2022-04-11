<?php

namespace App\Http\Requests\Availability;

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
                Rule::in(['S', 'M', 'L', 'XL']),
            ],
            'count' => 'required|integer'
        ];
    }
}
