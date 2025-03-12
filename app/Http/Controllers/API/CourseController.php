<?php
namespace App\Http\Controllers\Api;

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
        // Vérifier que l'utilisateur est un mentor
        if (!$request->user()->isMentor()) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string|in:draft,published',
        ]);

        $course = $this->courseService->createCourse([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'user_id' => $request->user()->id,
        ]);

        return new CourseResource($course);
    }

    public function show($id)
    {
        $course = $this->courseService->getCourseById($id);
        return new CourseResource($course);
    }

    public function update(Request $request, $id)
    {
        $course = $this->courseService->getCourseById($id);

        // Vérifier que l'utilisateur est le créateur du cours
        if ($request->user()->id !== $course->user_id) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'status' => 'sometimes|required|string|in:draft,published',
        ]);

        $course = $this->courseService->updateCourse($id, $request->all());

        return new CourseResource($course);
    }

    public function destroy(Request $request, $id)
    {
        $course = $this->courseService->getCourseById($id);

        // Vérifier que l'utilisateur est le créateur du cours
        if ($request->user()->id !== $course->user_id) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        $this->courseService->deleteCourse($id);

        return response()->json(null, 204);
    }

    public function enroll(Request $request, $id)
    {
        // Vérifier que le cours existe
        $course = $this->courseService->getCourseById($id);

        // Vérifier que l'utilisateur n'est pas le créateur du cours
        if ($request->user()->id === $course->user_id) {
            return response()->json(['message' => 'Vous ne pouvez pas vous inscrire à votre propre cours'], 400);
        }

        $this->courseService->enrollStudent($id, $request->user()->id);

        return response()->json(['message' => 'Inscription réussie']);
    }

    public function updateProgress(Request $request, $id)
    {
        $request->validate([
            'progress' => 'required|integer|min:0|max:100'
        ]);

        // Vérifier que le cours existe
        $this->courseService->getCourseById($id);

        $this->courseService->updateProgress($id, $request->user()->id, $request->progress);

        return response()->json(['message' => 'Progression mise à jour']);
    }

    public function enrolledCourses(Request $request)
    {
        $courses = $this->courseService->getStudentCourses($request->user()->id);
        return CourseResource::collection($courses);
    }

    public function myCourses(Request $request)
    {
        // Vérifier que l'utilisateur est un mentor
        if (!$request->user()->isMentor()) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        $courses = $this->courseService->getMentorCourses($request->user()->id);
        return CourseResource::collection($courses);
    }
}
