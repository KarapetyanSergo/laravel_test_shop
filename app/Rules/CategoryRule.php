<?php

namespace App\Rules;

use App\Http\Resources\CategoryRecource;
use App\Models\Category;
use Illuminate\Contracts\Validation\Rule;

class CategoryRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        return Category::where('id', $value)
            ->whereDoesntHave('children')
            ->exists();
    }

    public function message(): string
    {
        return 'Incorrect category id';
    }
}
