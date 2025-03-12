<?php
namespace App\Services;

use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Services\Interfaces\CourseServiceInterface;

class CourseService implements CourseServiceInterface
{
    protected $courseRepository;

    public function __construct(CourseRepositoryInterface $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function getAllCourses()
    {
        return $this->courseRepository->getAll();
    }

    public function getCourseById($id)
    {
        return $this->courseRepository->getById($id);
    }

    public function createCourse(array $data)
    {
        return $this->courseRepository->create($data);
    }

    public function updateCourse($id, array $data)
    {
        return $this->courseRepository->update($id, $data);
    }

    public function deleteCourse($id)
    {
        return $this->courseRepository->delete($id);
    }

    public function enrollStudent($courseId, $userId)
    {
        $this->courseRepository->enroll($courseId, $userId);
    }

    public function updateProgress($courseId, $userId, $progress)
    {
        // Valider la progression entre 0 et 100
        $progress = max(0, min(100, $progress));
        $this->courseRepository->updateProgress($courseId, $userId, $progress);
    }

    public function getStudentCourses($userId)
    {
        return $this->courseRepository->getStudentCourses($userId);
    }

    public function getMentorCourses($mentorId)
    {
        return $this->courseRepository->getMentorCourses($mentorId);
    }
}
