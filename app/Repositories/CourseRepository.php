<?php
namespace App\Repositories;

use App\Models\Course;
use App\Repositories\Interfaces\CourseRepositoryInterface;

class CourseRepository implements CourseRepositoryInterface
{
    public function getAll()
    {
        return Course::with(['user', 'category', 'tags'])->get();
    }

    public function getById($id)
    {
        return Course::with(['user', 'category', 'tags'])->findOrFail($id);
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

    public function getByCategoryId($categoryId)
    {
        return Course::where('category_id', $categoryId)
            ->with(['user', 'tags'])
            ->get();
    }

    public function attachTags($courseId, array $tagIds)
    {
        $course = Course::findOrFail($courseId);
        $course->tags()->sync($tagIds, false);
        return $course->tags;
    }

    public function detachTags($courseId, array $tagIds)
    {
        $course = Course::findOrFail($courseId);
        $course->tags()->detach($tagIds);
        return $course->tags;
    }
}
