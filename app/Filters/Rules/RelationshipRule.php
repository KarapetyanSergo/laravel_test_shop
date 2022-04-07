<?php

namespace App\Filters\Rules;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class RelationshipRule implements FilterRule
{
    private $column;
    private $relationship;

    public function __construct($modelColumn, $relationship)
    {
        $this->column = $modelColumn;
        $this->relationship = $relationship;
    }

    public function filtration(Builder $query, Collection $filterParameters): Builder
    {
        $relationship = $this->relationship;

        dd($query->where($this->column, $filterParameters)->get()->first()->$relationship->all());
    }
}
