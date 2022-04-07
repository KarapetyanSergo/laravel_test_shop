<?php

namespace App\Filters\Rules;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class SimpleRule implements FilterRule
{
    private $column;

    public function __construct($column)
    {
        $this->column = $column;
    }

    public function filtration(Builder $query, Collection $filterParameters): Builder
    {
        return $query->where($this->column, $filterParameters);
    }
}
