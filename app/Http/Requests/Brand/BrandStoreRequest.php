<?php

namespace App\Http\Requests\Brand;

use Illuminate\Foundation\Http\FormRequest;
use phpseclib3\File\ASN1\Maps\Name;

class BrandStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'country' => 'required|string',
        ];
    }
}
