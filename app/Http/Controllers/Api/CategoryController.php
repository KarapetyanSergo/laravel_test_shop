<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Category::whereDoesntHave('children')->get());
    }

    public function show(Category $category): JsonResponse
    {
        return response()->json($category);
    }

    public function store(CategoryStoreRequest $request): JsonResponse
    {
        return response()->json(Category::create($request->validated()));
    }

    public function destroy(Category $category): JsonResponse
    {
        $category->delete();

        return response()->json($category);
    }
}
