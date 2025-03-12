<?php
namespace App\Repositories\Interfaces;

interface CourseRepositoryInterface
{
    public function getAll();
    public function getById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function enroll($courseId, $userId);
    public function updateProgress($courseId, $userId, $progress);
    public function getStudentCourses($userId);
    public function getMentorCourses($mentorId);
}
