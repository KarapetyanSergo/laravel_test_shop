<?php

namespace App\Services;

use App\Filters\MinMaxFilter;
use App\Filters\RelationshipFilter;
use App\Filters\SearchFilter;
use App\Filters\SimpleFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class FilterService
{
    private function rules(): Collection
    {
        return Collection::make([
            'category_id' => new SimpleFilter('category_id'),
            'color' => new SimpleFilter('color'),
            'price' => new MinMaxFilter('price'),
            'user_search' => new SearchFilter(['name', 'email']),
            'category_product' => new RelationshipFilter('name', 'product')
        ]);
    }

    public function filtration(Collection $filters, Model $query): Builder
    {
        foreach ($filters as $key => $filter) {
            $query = $this->rules()->all()[$key]->filtration($query, Collection::make($filter));
        }

        return $query;
    }
}
