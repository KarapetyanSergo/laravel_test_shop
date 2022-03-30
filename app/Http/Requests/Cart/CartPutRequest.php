<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

class CartPutRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'size' => 'string|max:10',
            'count' => 'integer'
        ];
    }
}
