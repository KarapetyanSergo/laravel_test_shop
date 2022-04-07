<?php

namespace App\Filters\Rules;

use App\Filters\FilterRule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class SearchRule implements FilterRule
{
    private array $columns;

    public function __construct($columns)
    {
        $this->columns = $columns;
    }

    public function filtration(Builder $query, Collection $filterParameters): Builder
    {
        foreach ($this->columns as $column) {
            $query = $query->where($column, 'like', '%'.$filterParameters->first().'%');
        }

        return $query;
    }
}
