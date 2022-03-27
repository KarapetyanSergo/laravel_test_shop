<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

class CartStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'product_id' => 'required|integer|exists:products,id',
            'size' => 'required|string|max:10'
        ];
    }
}
