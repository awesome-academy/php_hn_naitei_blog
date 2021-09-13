<?php

namespace App\Repositories;

use App\Repositories\Contracts\StoryRepositoryInterface;
use App\Models\Story;

class StoryRepository implements StoryRepositoryInterface
{
    public function all()
    {
        return Story::all();
    }

    public function findOrFail($id)
    {
        return Story::findOrFail($id);
    }

    public function create($data)
    {
        return Story::create($data);
    }

    public function forceDelete($id)
    {
        return Story::withTrashed()->where('id', $id)->forceDelete();
    }

}
