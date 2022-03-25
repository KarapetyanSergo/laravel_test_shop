<?php

namespace App\Rules;

use App\Http\Resources\CategoryRecource;
use App\Models\Category;
use Illuminate\Contracts\Validation\Rule;

class CategoryRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        $children = Category::where('id', $value)
            ->whereDoesntHave('children')
            ->get()
            ->all();

        if(!$children) {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return 'Incorrect category id';
    }
}
