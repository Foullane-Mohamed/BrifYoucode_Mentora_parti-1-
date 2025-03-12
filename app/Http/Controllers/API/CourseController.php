<?php
namespace App\Http\Controllers\Api\CourseController;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Services\Interfaces\CourseServiceInterface;
use Illuminate\Http\Request;



class CourseController extends Controller
{
    protected $courseService;

    public function __construct(CourseServiceInterface $courseService)
    {
        $this->courseService = $courseService;
    }

    public function index()
    {
        $courses = $this->courseService->getAllCourses();
        return CourseResource::collection($courses);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:draft,published',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $course = $this->courseService->createCourse($validated);

        return new CourseResource($course);
    }

    public function show($id)
    {
        $course = $this->courseService->getCourseById($id);
        return new CourseResource($course);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'status' => 'sometimes|in:draft,published',
            'user_id' => 'sometimes|exists:users,id',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $course = $this->courseService->updateCourse($id, $validated);

        return new CourseResource($course);
    }

    public function destroy($id)
    {
        $this->courseService->deleteCourse($id);
        return response()->json(['message' => 'Cours supprimé avec succès'], 200);
    }

    public function coursesByCategory($categoryId)
    {
        $courses = $this->courseService->getCoursesByCategory($categoryId);
        return CourseResource::collection($courses);
    }

    public function attachTags(Request $request, $courseId)
    {
        $validated = $request->validate([
            'tag_ids' => 'required|array',
            'tag_ids.*' => 'exists:tags,id',
        ]);

        $tags = $this->courseService->attachTagsToCourse($courseId, $validated['tag_ids']);

        return response()->json([
            'message' => 'Tags ajoutés avec succès',
            'tags' => TagResource::collection($tags)
        ]);
    }

    public function detachTags(Request $request, $courseId)
    {
        $validated = $request->validate([
            'tag_ids' => 'required|array',
            'tag_ids.*' => 'exists:tags,id',
        ]);

        $tags = $this->courseService->detachTagsFromCourse($courseId, $validated['tag_ids']);

        return response()->json([
            'message' => 'Tags supprimés avec succès',
            'tags' => TagResource::collection($tags)
        ]);
    }
}
