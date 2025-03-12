<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\Str;

class CategoryRepository implements CategoryRepositoryInterface
{
public function getAll()
{
return Category::all();
}

public function getById($id)
{
return Category::with('courses')->findOrFail($id);
}

public function getBySlug($slug)
{
return Category::where('slug', $slug)->firstOrFail();
}

public function create(array $data)
{
// Générer le slug si non fourni
if (!isset($data['slug'])) {
$data['slug'] = Str::slug($data['name']);
}

return Category::create($data);
}

public function update($id, array $data)
{
$category = Category::findOrFail($id);

// Mettre à jour le slug si le nom est modifié
if (isset($data['name']) && !isset($data['slug'])) {
$data['slug'] = Str::slug($data['name']);
}

$category->update($data);
return $category;
}

public function delete($id)
{
$category = Category::findOrFail($id);
return $category->delete();
}
}
