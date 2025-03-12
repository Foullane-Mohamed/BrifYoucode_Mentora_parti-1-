<?php

namespace App\Services\Interfaces\CategoryServiceInterface;

interface CategoryServiceInterface
{
    public function getAllCategories();
    public function getCategoryById($id);
    public function getCategoryBySlug($slug);
    public function createCategory(array $data);
    public function updateCategory($id, array $data);
    public function deleteCategory($id);
}
