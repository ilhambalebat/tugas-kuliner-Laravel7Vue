<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Resources\Posts\PostCollection;
use App\Models\Posts\Subject;

class SubjectController extends Controller
{
    public function index()
    {
        return Subject::get(['id', 'name']);
    }

    public function show(Subject $subject)
    {
        // $posts = $subject->posts()->latest()->paginate(request('perPage'));
        // return new PostCollection($posts);
        $posts = $subject->posts()->latest()->paginate(request('perPage'));
        return (new PostCollection($posts))->additional(['subject' => $subject]);
    }
}
