<?php

namespace App\Http\Requests\Cart;

use App\Rules\CartRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CartPutRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'size' => 'string|max:10',
            'count' => [
                'integer',
                new CartRule($this->product_id, $this->size)
            ],
            'product_id' => [
                'required',
                Rule::exists('product_user')->where(function ($query) {
                    return $query
                        ->whereUserId(Auth::user()->id)
                        ->whereProductId($this->product_id);
                }),
            ],

        ];
    }
}
