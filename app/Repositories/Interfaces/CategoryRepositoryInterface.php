<?php
namespace App\Repositories\Interfaces\CategoryRepositoryInterface;
interface CategoryRepositoryInterface{
    public function getAllCategories();
    public function getCategoryByName($name);
    public function createCategory($data);
    public function updateCategory($data);
    public function deleteCategory($id);
}
