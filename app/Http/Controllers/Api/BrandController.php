<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\BrandStoreRequest;
use App\Http\Requests\Brand\BrandStatusChangeRequest;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class BrandController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Brand::all());
    }

    public function show(Brand $brand): JsonResponse
    {
        return response()->json($brand);
    }

    public function store(BrandStoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['status'] = 'Not Confirmed';

        return response()->json(Brand::create($data));
    }

    public function destroy(Brand $brand): JsonResponse
    {
        $brand->delete();

        return response()->json($brand);
    }

    public function updateStatus(BrandStatusChangeRequest $request, Brand $brand): JsonResponse
    {
        $brand->update($request->validated());

        return response()->json($brand);
    }
}
