<?php


namespace App\Services\Interfaces;

interface CourseServiceInterface
{
    public function getAllCourses();
    public function getCourseById($id);
    public function createCourse(array $data);
    public function updateCourse($id, array $data);
    public function deleteCourse($id);
    public function enrollStudent($courseId, $userId);
    public function updateProgress($courseId, $userId, $progress);
    public function getStudentCourses($userId);
    public function getMentorCourses($mentorId);
}
