<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function index(CategoryService $service): JsonResponse
    {
        return response()->json($service->index());
    }

    public function show(Category $category): JsonResponse
    {
        return response()->json($category);
    }

    public function store(CategoryStoreRequest $request, CategoryService $service): JsonResponse
    {
        return response()->json($service->store($request));
    }

    public function destroy(Category $category, CategoryService $service): JsonResponse
    {
        return response()->json($service->destroy($category));
    }
}
