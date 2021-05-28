<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
