<?php

namespace App\Filters\Rules;

use App\Filters\FilterRule;
use Illuminate\Database\Eloquent\Builder;

class RangeRule implements FilterRule
{
    private string $column;

    public function __construct($column)
    {
        $this->column = $column;
    }

    public function filter(Builder $query, $value): Builder
    {
        return $query->whereBetween($this->column, [$value['min'], $value['max']]);
    }
}
