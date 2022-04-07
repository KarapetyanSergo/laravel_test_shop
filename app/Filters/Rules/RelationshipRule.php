<?php

namespace App\Filters\Rules;

use App\Filters\FilterRule;
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

    public function filter(Builder $query, $value): Builder
    {
        $relationship = $this->relationship;

        dd($query->where($this->column, $value)->get()->first()->$relationship->all());
    }
}
