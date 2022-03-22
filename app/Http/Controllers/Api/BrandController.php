<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\BrandStoreRequest;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        return Brand::all();
    }

    public function show(Brand $brand)
    {
        return $brand;
    }

    public function store(BrandStoreRequest $request)
    {
        return Brand::create($request->validated());
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();

        return $brand;
    }
}
