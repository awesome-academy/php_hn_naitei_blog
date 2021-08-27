<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Story;
use App\Models\User;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'status',
        'parent',
    ];

    public function story()
    {
        return $this->belongsTo(Story::class, 'stories_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
