<?php

namespace App\Repositories\Contracts;

interface StoryRepositoryInterface
{
    public function all();
    public function findOrFail($id);
    public function create($data);
    public function forceDelete($id);
    public function delete($id);
}
