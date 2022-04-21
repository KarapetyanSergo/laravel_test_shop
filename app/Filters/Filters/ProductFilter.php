<?php

namespace App\Filters\Filters;

use App\Filters\Filter;
use App\Filters\Rules\RangeRule;
use App\Filters\Rules\RelationRule;
use App\Filters\Rules\SimpleRule;
use Illuminate\Database\Eloquent\Collection;
use App\Filters\Relation;

class ProductFilter extends Filter
{
    public function rules(): Collection
    {
        return Collection::make([
            'category_id' => new SimpleRule('category_id'),
            'color' => new SimpleRule('color'),
            'price' => new RangeRule('price'),
            'category_name' => new Relation('category', new SimpleRule('name')),
            'category_boz' => new Relation('category', new SimpleRule('boz')),

        ]);

        Product::query()
            ->whereHas('orders', function ($b) {
                $b->where('status', '=', 1);
            })
            ->whereHas('orders', function ($b) {
                $b->where('status', '!=', 1);
            })
            ->get();
    }
}
