<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductPutRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'size' => 'string|max:255',
            'color' => 'string|max:255',
            'price' =>  'integer',
            'category_id' => 'exists:categories,id|integer'
        ];
    }
}
