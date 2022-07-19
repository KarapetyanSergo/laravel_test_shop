<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\BrandStoreRequest;
use App\Http\Requests\Brand\BrandStatusChangeRequest;
use App\Models\Brand;
use BrandService;
use Illuminate\Http\JsonResponse;

class BrandController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json($this->getDataResponse(Brand::all()));
    }

    public function show(Brand $brand): JsonResponse
    {
        return response()->json($this->getDataResponse($brand));
    }

    public function store(BrandService $brandService, BrandStoreRequest $request): JsonResponse
    {
        return response()->json($this->getDataResponse($brandService->create($request->validated())));
    }

    public function destroy(BrandService $brandService, Brand $brand): JsonResponse
    {
        return response()->json($this->getDataResponse($brandService->remove($brand)));
    }

    public function updateStatus(BrandService $brandService, BrandStatusChangeRequest $request, Brand $brand): JsonResponse
    {
        return response()->json($this->getDataResponse($brandService->update($brand, $request->validated())));
    }
}
