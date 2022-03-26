<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\BrandStoreRequest;
use App\Http\Requests\Brand\BrandStatusChangeRequest;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Collection;

class BrandController extends Controller
{
    public function index(): Collection
    {
        return Brand::all();
    }

    public function show(Brand $brand): Brand
    {
        return $brand;
    }

    public function store(BrandStoreRequest $request): Brand
    {
        $data = $request->validated();
        $data['status'] = 'Not Confirmed';

        return Brand::create($data);
    }

    public function destroy(Brand $brand): Brand
    {
        $brand->delete();

        return $brand;
    }

    public function updateStatus(BrandStatusChangeRequest $request, Brand $brand): Brand
    {
        $brand->update($request->validated());

        return $brand;
    }
}
