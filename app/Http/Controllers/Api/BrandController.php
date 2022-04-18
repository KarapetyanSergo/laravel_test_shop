<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\BrandStoreRequest;
use App\Http\Requests\Brand\BrandStatusChangeRequest;
use App\Models\Brand;
use App\Services\BrandService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class BrandController extends Controller
{
    public function index(BrandService $service): JsonResponse
    {
        return response()->json($service->index());
    }

    public function show(Brand $brand): JsonResponse
    {
        return response()->json($brand);
    }

    public function store(BrandStoreRequest $request, BrandService $service): JsonResponse
    {
        return response()->json($service->store($request));
    }

    public function destroy(Brand $brand, BrandService $service): JsonResponse
    {
        return response()->json($service->destroy($brand));
    }

    public function updateStatus(BrandStatusChangeRequest $request, Brand $brand, BrandService $service): JsonResponse
    {
        return response()->json($service->updateStatus($request, $brand));
    }
}
