<?php

namespace App\Http\Controllers\Api\CategoryResource;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Services\Interfaces\CategoryServiceInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return CategoryResource::collection($categories);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'slug' => 'nullable|string|unique:categories,slug',
        ]);

        $category = $this->categoryService->createCategory($validated);

        return new CategoryResource($category);
    }

    public function show($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        return new CategoryResource($category);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'slug' => 'nullable|string|unique:categories,slug,' . $id,
        ]);

        $category = $this->categoryService->updateCategory($id, $validated);

        return new CategoryResource($category);
    }

    public function destroy($id)
    {
        $this->categoryService->deleteCategory($id);
        return response()->json(['message' => 'Catégorie supprimée avec succès'], 200);
    }

    public function getBySlug($slug)
    {
        $category = $this->categoryService->getCategoryBySlug($slug);
        return new CategoryResource($category);
    }
}
