<?php

namespace App\Filters\Rules;

use App\Filters\FilterRule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class SimpleRule implements FilterRule
{
    private $column;

    public function __construct($column)
    {
        $this->column = $column;
    }

    public function filter(Builder $query, $value): Builder
    {
        return $query->where($this->column, $value);
    }
}
