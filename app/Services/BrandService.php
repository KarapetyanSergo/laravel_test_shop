<?php

namespace App\Services;

use App\Http\Requests\Brand\BrandStatusChangeRequest;
use App\Http\Requests\Brand\BrandStoreRequest;
use App\Models\Brand;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class BrandService
{
    public function index(): Collection
    {
        return Brand::all();
    }

    public function store(BrandStoreRequest $request): Brand
    {
        $data = $request->validated();
        $data['status'] = 'Not Confirmed';

        return Brand::create($data);
    }

    public function destroy(Brand $brand): array
    {
        $brand->delete();

        return [
            'message' => 'Success'
        ];
    }

    public function updateStatus(BrandStatusChangeRequest $request, Brand $brand): Brand
    {
        $brand->update($request->validated());

        return $brand;
    }
}
