<?php

use App\Models\Brand;

class BrandService 
{
    public function create(array $data): Brand
    {
        $data['status'] = 'Not Confirmed';

        return Brand::create($data);
    }

    public function remove(Brand $brand): array
    {
        $brand->delete();

        return [
            'Brand deleted succesfully.'
        ];
    }

    public function update(Brand $brand, array $data): Brand
    {
        $brand->update($data);

        return $brand;
    }
}