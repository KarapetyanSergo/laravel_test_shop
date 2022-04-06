<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'  =>  'required',
            'email'  =>  'required|email|unique:users',
            'password'  =>  'required|min:8|confirmed',
            'type' => 'required|string'
        ];
    }
}
