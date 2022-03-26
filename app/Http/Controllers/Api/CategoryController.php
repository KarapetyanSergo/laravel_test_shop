<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Models\Category;
use Ramsey\Collection\Collection;

class CategoryController extends Controller
{
    public function index(): Collection
    {
        return Category::whereDoesntHave('children')->get();
    }

    public function show(Category $category): Category
    {
        return $category;
    }

    public function store(CategoryStoreRequest $request): Category
    {
        return Category::create($request->validated());
    }

    public function destroy(Category $category): Category
    {
        $category->delete();

        return $category;
    }
}
