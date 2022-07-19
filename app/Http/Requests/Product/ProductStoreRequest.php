<?php

namespace App\Http\Requests\Product;

use App\Rules\CategoryRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'color' => 'required|string|max:255',
            'price' =>  'required|integer',
            'category_id' => [
                'required',
                'integer',
                new CategoryRule()
            ]
        ];
    }
}
