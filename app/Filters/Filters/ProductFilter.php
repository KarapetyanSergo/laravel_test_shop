<?php

namespace App\Filters\Filters;

use App\Filters\Filter;
use App\Filters\Rules\RangeRule;
use App\Filters\Rules\RelationRule;
use App\Filters\Rules\SimpleRule;
use Illuminate\Database\Eloquent\Collection;

class ProductFilter extends Filter
{
    public function rules(): Collection
    {
        return Collection::make([
            'category_id' => new SimpleRule('category_id'),
            'color' => new SimpleRule('color'),
            'price' => new RangeRule('price'),
            'category_product' => new RelationRule('name', 'categories'),
            'category_name' => new SimpleRule('name'),
        ]);
    }
}
