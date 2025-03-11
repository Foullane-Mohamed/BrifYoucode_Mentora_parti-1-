<?php
namespace App\Repositories\Interfaces\SubcategoryRepositoryInterface;

interface tagRepositoryInterface{
    public function getAllSubcategories();

    public function getSubcategoriesById($id);
    public function getSubcategoriesByCategoryId($id);
    public function createSubcategory($data);
    public function updateSubcategory($data);
    public function deleteSubcategory($id);
}
