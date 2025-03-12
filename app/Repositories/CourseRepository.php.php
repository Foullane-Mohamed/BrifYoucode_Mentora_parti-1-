<?php

namespace App\Repositories;

use App\Models\Course;
use App\Repositories\Interfaces\CourseRepositoryInterface;

class CourseRepository implements CourseRepositoryInterface
{
    public function getAll()
    {
        return Course::with('user')->get();
    }

    public function getById($id)
    {
        return Course::with(['user', 'students'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Course::create($data);
    }

    public function update($id, array $data)
    {
        $course = Course::findOrFail($id);
        $course->update($data);
        return $course;
    }

    public function delete($id)
    {
        $course = Course::findOrFail($id);
        return $course->delete();
    }

    public function enroll($courseId, $userId)
    {
        $course = Course::findOrFail($courseId);
        $course->students()->syncWithoutDetaching([
            $userId => ['progress' => 0]
        ]);
    }

    public function updateProgress($courseId, $userId, $progress)
    {
        $course = Course::findOrFail($courseId);
        $course->students()->updateExistingPivot($userId, [
            'progress' => $progress
        ]);
    }

    public function getStudentCourses($userId)
    {
        return Course::whereHas('students', function ($query) use ($userId) {
            $query->where('users.id', $userId);
        })->with('user')->get();
    }

    public function getMentorCourses($mentorId)
    {
        return Course::where('user_id', $mentorId)->with('students')->get();
    }
}
