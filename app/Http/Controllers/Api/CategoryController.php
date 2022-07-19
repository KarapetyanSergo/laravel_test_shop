<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Models\Category;
use CategoryService;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json($this->getDataResponse(Category::whereDoesntHave('children')->get()));
    }

    public function show(Category $category): JsonResponse
    {
        return response()->json($this->getDataResponse($category));
    }

    public function store(CategoryStoreRequest $request, CategoryService $service): JsonResponse
    {
        return response()->json($this->getDataResponse($service->create($request->validated())));
    }

    public function destroy(Category $category, CategoryService $service): JsonResponse
    {
        return response()->json($service->delete($category));
    }
}
