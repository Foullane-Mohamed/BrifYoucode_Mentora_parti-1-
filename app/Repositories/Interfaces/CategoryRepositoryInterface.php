<?php

namespace App\Repositories\Interfaces;

interface CategoryRepositoryInterface
{
    public function getAll();
    public function getById($id);
    public function getBySlug($slug);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
