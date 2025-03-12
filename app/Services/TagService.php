<?php

namespace App\Services\TagService;

use App\Repositories\Interfaces\TagRepositoryInterface;
use App\Services\Interfaces\TagServiceInterface;

class TagService implements TagServiceInterface
{
    protected $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function getAllTags()
    {
        return $this->tagRepository->getAll();
    }

    public function getTagById($id)
    {
        return $this->tagRepository->getById($id);
    }

    public function getTagBySlug($slug)
    {
        return $this->tagRepository->getBySlug($slug);
    }

    public function createTag(array $data)
    {
        return $this->tagRepository->create($data);
    }

    public function updateTag($id, array $data)
    {
        return $this->tagRepository->update($id, $data);
    }

    public function deleteTag($id)
    {
        return $this->tagRepository->delete($id);
    }

    public function getCoursesByTag($tagId)
    {
        return $this->tagRepository->getCoursesByTagId($tagId);
    }
}
