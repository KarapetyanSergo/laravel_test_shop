<?php

namespace App\Filters;

use App\Filters\Rules\MinMaxRule;
use App\Filters\Rules\RelationshipRule;
use App\Filters\Rules\SimpleRule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ProductFilter extends Filter
{
    public function rules(): Collection
    {
        return Collection::make([
            'category_id' => new SimpleRule('category_id'),
            'color' => new SimpleRule('color'),
            'price' => new MinMaxRule('price'),
            'category_product' => new RelationshipRule('name', 'product')
        ]);
    }
}
