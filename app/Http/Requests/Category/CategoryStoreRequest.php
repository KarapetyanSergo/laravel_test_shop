<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'  => 'required|string',
            'parent_id' =>  'integer|exists:categories,id',
        ];
    }
}
