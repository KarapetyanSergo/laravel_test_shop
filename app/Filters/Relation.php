<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use App\Filters\Rules\SimpleRule;
use App\Filters\Rules\SearchRule;

class Relation {
    private $relation;
    private $column;
    private $method;

    public function __construct(string $relation, $column, string $method)
    {
        $this->relation = $relation;
        $this->column = $column;
        $this->method = $method;
    }

    public function filter(Builder $query, $value): Builder
    {
        return $query->whereHas($this->relation, function ($query) use($value) {
            $method = $this->method;
            return $this->$method($query, $value);
        });
    }

    private function simple(Builder $query, $value): Builder
    {
        $rule = new SimpleRule($this->column);

        return $rule->filter($query, $value);
    }

    private function search(Builder $query, $value): Builder
    {
        $rule = new SearchRule($this->column);

        return $rule->filter($query, $value);
    }
}
