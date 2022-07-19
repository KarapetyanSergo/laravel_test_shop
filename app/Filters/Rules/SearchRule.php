<?php

namespace App\Filters\Rules;

use App\Filters\FilterRule;
use Illuminate\Database\Eloquent\Builder;

class SearchRule implements FilterRule
{
    private array $columns;

    public function __construct($columns)
    {
        $this->columns = $columns;
    }

    public function filter(Builder $query, $value): Builder
    {
        foreach ($this->columns as $column) {
            $query = $query->orWhere($column, 'like', '%'.$value.'%');
        }

        return $query;
    }
}
