<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Story;
use App\Models\User;

class Bookmark extends Model
{
    public function story()
    {
        return $this->belongsTo(Story::class, 'stories_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
