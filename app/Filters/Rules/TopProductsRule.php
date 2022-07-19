<?php

namespace App\Filters\Rules;

use App\Filters\FilterRule;
use App\Models\OrderProduct;
use Illuminate\Database\Eloquent\Builder;

class TopProductsRule implements FilterRule
{
    public function filter(Builder $query, $value): Builder
    {
        $topProductIds = OrderProduct::select('product_id')
            ->groupBy('product_id')
            ->orderByDesc('product_id')
            ->limit($value)
            ->get()
            ->all();

        foreach ($topProductIds as $id) {
            $query = $query->orWhere('id', $id->product_id);
        }

        return $query;
    }
}
