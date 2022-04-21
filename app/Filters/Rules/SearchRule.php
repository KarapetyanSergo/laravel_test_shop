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
         return $query->where(function($query) use ($value) {
            foreach ($this->columns as $index => $column) {
                $query = $query->orWhere($column, 'like', '%'.$value.'%'); 
            }
        });
    }
}
