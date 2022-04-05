<?php

namespace App\Http\Requests\Cart;

use App\Rules\CartRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CartStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'product_id' => [
                'required',
                'integer',
                'exists:products,id',
                Rule::unique('product_user')->where(function ($query) {
                    return $query
                        ->whereUserId(Auth::user()->id)
                        ->whereProductId($this->product_id);
                }),
            ],
            'size' => 'required|string|max:10',
            'count' => [
                'required',
                'integer',
                new CartRule($this->product_id, $this->size)
            ]
        ];
    }
}
