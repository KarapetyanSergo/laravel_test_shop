<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryStoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'  => [
                'required',
                'string',
                'unique:categories,name',
            ],
            'parent_id' =>  [
                'integer',
                'exists:categories,id',
            ]
        ];
    }
}
