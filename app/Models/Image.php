<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'image_url',
    ];
    
    public function imageable()
    {
        return $this->morphTo();
    }
}
