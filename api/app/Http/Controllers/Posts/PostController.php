<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Resources\Posts\PostCollection;
use App\Http\Resources\Posts\PostResource;
use App\Models\Posts\Post;
use App\Models\Posts\Subject;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user', 'subject')->latest()->paginate(request('perPage'));
        return new PostCollection(($posts));
    }

    public function show(Subject $subject, Post $post)
    {
        return new PostResource($post);
    }

    public function store()
    {
        $this->requestValidate();
        auth()->user()->posts()->create([
            'title' => request('title'),
            'slug' => \Str::slug(request('title')) . \Str::random(6),
            'body' => request('body'),
            'subject_id' => request('subject')
        ]);

        return response()->json(['success' => 'The post was created']);
    }

    public function update(Post $post)
    {
        $this->requestValidate();

        $post->update([
            'title' => request('title'),
            'body' => request('body'),
            'subject_id' => request('subject')
        ]);
        return response()->json(['success' => 'The post was updated']);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(['success' => 'The post was deleted']);
    }

    public function requestValidate()
    {
        return request()->validate([
            'title' => 'required|min:6',
            'body' => 'required',
            'subject' => 'required'
        ]);
    }
}
