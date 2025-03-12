<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Http\Resources\TagResource;
use App\Services\Interfaces\TagServiceInterface;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $tagService;

    public function __construct(TagServiceInterface $tagService)
    {
        $this->tagService = $tagService;
    }

    public function index()
    {
        $tags = $this->tagService->getAllTags();
        return TagResource::collection($tags);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:tags,slug',
        ]);

        $tag = $this->tagService->createTag($validated);

        return new TagResource($tag);
    }

    public function show($id)
    {
        $tag = $this->tagService->getTagById($id);
        return new TagResource($tag);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'slug' => 'nullable|string|unique:tags,slug,' . $id,
        ]);

        $tag = $this->tagService->updateTag($id, $validated);

        return new TagResource($tag);
    }

    public function destroy($id)
    {
        $this->tagService->deleteTag($id);
        return response()->json(['message' => 'Tag supprimé avec succès'], 200);
    }

    public function getBySlug($slug)
    {
        $tag = $this->tagService->getTagBySlug($slug);
        return new TagResource($tag);
    }

    public function coursesByTag($id)
    {
        $courses = $this->tagService->getCoursesByTag($id);
        return CourseResource::collection($courses);
    }
}
