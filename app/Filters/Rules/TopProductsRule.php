<?php

namespace App\Filters\Rules;

use App\Filters\FilterRule;
use Illuminate\Database\Eloquent\Builder;

class TopProductsRule implements FilterRule
{
    public function filter(Builder $query, $value): Builder
    {
        return $query->withCount('orders')
            ->orderBy('orders_count', 'desc')
            ->limit($value);
    }
}
