<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class RelationshipFilter implements Filter
{
    private $column;
    private $relationship;

    public function __construct($modelColumn, $relationship)
    {
        $this->column = $modelColumn;
        $this->relationship = $relationship;
    }

    public function filtration(Model $query, Collection $value): Builder
    {
        $relationship = $this->relationship;

        dd($query->where($this->column, $value)->get()->first()->$relationship->all());
    }
}
