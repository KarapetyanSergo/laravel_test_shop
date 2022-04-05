<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class FilterService
{
    private function rules(): Collection
    {
        return Collection::make([
            'category_id' => function ($query, $value) {
                return $query->where('category_id', $value);
            },

            'color' => function ($query, $value) {
                return $query->where('color', $value);
            }
        ]);
    }

    public function filtration(Collection $filters, Model $query): Builder
    {
        foreach ($filters as $key => $filter) {
            $query = $this->rules()->all()[$key]($query, $filter);
        }

        return $query;
    }
}
