<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class SearchFilter implements Filter
{
    private array $columns;

    public function __construct($columns)
    {
        $this->columns = $columns;
    }

    public function filtration(Builder $query, Collection $value): Builder
    {
        foreach ($this->columns as $column) {
            $query = $query->where($column, 'like', '%'.$value->first().'%');
        }

        return $query;
    }
}
