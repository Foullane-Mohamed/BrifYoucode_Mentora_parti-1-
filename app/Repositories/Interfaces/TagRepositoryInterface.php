<?php
namespace App\Repositories\Interfaces\TagRepositoryInterface;


interface TagRepositoryInterface{
    public function getAllTags();
    public function getTagById($id);
    public function getTagByCategoryId($id);
    public function createTag($data);
    public function updateTag($data);
    public function deleteTag($id);

}
