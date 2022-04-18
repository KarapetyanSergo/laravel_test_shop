<?php

namespace App\Services;

use App\Http\Requests\Category\CategoryStoreRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class CategoryService
{
    public function index(): Collection
    {
        return Category::whereDoesntHave('children')->get();
    }

    public function store(CategoryStoreRequest $request): array
    {
        Category::create($request->validated());

        return [
            'message' => 'success!'
        ];
    }

    public function destroy(Category $category): array
    {
        $category->delete();

        return [
            'message' => 'success!'
        ];
    }
}
