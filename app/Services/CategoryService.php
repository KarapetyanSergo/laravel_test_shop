<?php

use App\Models\Category;

class CategoryService
{
    public function create(array $data): Category
    {
        return Category::create($data);
    }

    public function delete(Category $category): array
    {
        $category->delete();

        return [
            'Category deleted succesfully.'
        ];
    }
}