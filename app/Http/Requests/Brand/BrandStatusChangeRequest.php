<?php

namespace App\Http\Requests\Brand;

use Illuminate\Foundation\Http\FormRequest;

class BrandStatusChangeRequest extends FormRequest
{
    public function rules()
    {
        return [
            'status' => 'required|string|regex:/^[confirmed]+$/',
        ];
    }
}
