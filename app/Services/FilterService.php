<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FilterService
{
    private function rules(): Collection
    {
        return Collection::make([
            'category_id' => function ($query, $value) {
                $query->where('category_id', $value);
            },

            'color' => function ($query, $value) {
                $query->where('color', $value);
            }
        ]);
    }

    public function filtration(Array $filters, Model $query): Model
    {
        foreach ($filters as $key=>$filter) {
            $this->rules()->all()[$key]($query, $filter);
        }

        return $query;
    }
}
