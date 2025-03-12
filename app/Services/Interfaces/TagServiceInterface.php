<?php

namespace App\Services\Interfaces\TagServiceInterface;

use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Services\Interfaces\CourseServiceInterface;



interface TagServiceInterface
{
    public function getAllTags();
    public function getTagById($id);
    public function getTagBySlug($slug);
    public function createTag(array $data);
    public function updateTag($id, array $data);
    public function deleteTag($id);
    public function getCoursesByTag($tagId);
}
