<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Repositories\Interfaces\TagRepositoryInterface;
use Illuminate\Support\Str;

class TagRepository implements TagRepositoryInterface
{
    public function getAll()
    {
        return Tag::all();
    }

    public function getById($id)
    {
        return Tag::with('courses')->findOrFail($id);
    }

    public function getBySlug($slug)
    {
        return Tag::where('slug', $slug)->firstOrFail();
    }

    public function create(array $data)
    {
        // Générer le slug si non fourni
        if (!isset($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        return Tag::create($data);
    }

    public function update($id, array $data)
    {
        $tag = Tag::findOrFail($id);

        // Mettre à jour le slug si le nom est modifié
        if (isset($data['name']) && !isset($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        $tag->update($data);
        return $tag;
    }

    public function delete($id)
    {
        $tag = Tag::findOrFail($id);
        return $tag->delete();
    }

    public function getCoursesByTagId($tagId)
    {
        $tag = Tag::findOrFail($tagId);
        return $tag->courses()->with(['user', 'category'])->get();
    }
}
