<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class CategoryService
{
    public function getPaginatedCategories(?string $searchQuery = null, int $perPage = 10): LengthAwarePaginator
    {
        $categories = Category::query();

        if ($searchQuery) {
            $categories->where('category', 'like', '%' . $searchQuery . '%');
        }

        return $categories->latest()->paginate($perPage);
    }

    public function createCategory(array $data): Category
    {
        $data['slug'] = Str::slug($data['category']);
        return Category::create($data);
    }

    public function updateCategory(Category $category, array $data): Category
    {
        $data['slug'] = Str::slug($data['category']);
        $category->update($data);
        return $category;
    }

    public function deleteCategory(Category $category): void
    {
        $category->delete();
    }
}
