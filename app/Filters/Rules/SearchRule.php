<?php

namespace App\Filters\Rules;

use App\Filters\FilterRule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class SearchRule implements FilterRule
{
    private array $columns;

    public function __construct(array $columns)
    {
        $this->columns = $columns;
    }

    public function filter(Builder $query, $value): Builder
    {

        foreach ($this->columns as $index => $column) {
            if ($index == 0) {
                $query = $query->where($column, 'like', '%'.$value.'%');
                continue;
            }

            $query = $query->orWhere($column, 'like', '%'.$value.'%');
        }

        return $query;
    }
}
