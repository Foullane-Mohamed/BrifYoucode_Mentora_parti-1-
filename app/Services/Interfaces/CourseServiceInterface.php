<?php

namespace App\Services\Interfaces\CourseServiceInterface;

interface CourseServiceInterface
{
    public function getAllCourses();
    public function getCourseById($id);
    public function createCourse(array $data);
    public function updateCourse($id, array $data);
    public function deleteCourse($id);
    public function getCoursesByCategory($categoryId);
    public function attachTagsToCourse($courseId, array $tagIds);
    public function detachTagsFromCourse($courseId, array $tagIds);
}
