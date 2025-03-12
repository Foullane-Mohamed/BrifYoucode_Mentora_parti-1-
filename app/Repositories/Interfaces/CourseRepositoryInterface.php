<?php


namespace App\Repositories\Interfaces;

interface CourseRepositoryInterface
{
    public function getAll();
    public function getById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function getByCategoryId($categoryId);
    public function attachTags($courseId, array $tagIds);
    public function detachTags($courseId, array $tagIds);
}
