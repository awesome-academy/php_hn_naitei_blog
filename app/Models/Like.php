<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Story;
use App\Models\User;

class Like extends Model
{
    public function story()
    {
        return $this->belongsTo(Story::class);
    }

    public function user()
    {
        return $this->belongsTo('User');
    }
}
