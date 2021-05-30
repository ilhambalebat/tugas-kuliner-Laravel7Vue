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

    public function store(Request $request)
    {
        $this->requestValidate();
        $imageName = time() . '.jpg';
        $path = public_path('images');

        auth()->user()->posts()->create([
            'title' => request('title'),
            'slug' => \Str::slug(request('title')) . '-' . \Str::random(6),
            'body' => request('body'),
            'price' => request('price'),
            'subject_id' => request('subject'),
            'photo' => $imageName
        ]);

        $request->photo->move(public_path('images'), $imageName);
        return response()->json(['success' => 'The post was created']);
    }

    public function update(Post $post, Request $request)
    {
        $this->requestValidate();
        $photo = $request->photo;
        if (is_string($photo)) :
            $post->update([
                'title' => request('title'),
                'body' => request('body'),
                'subject_id' => request('subject'),
                'price' => request('price')
            ]);
        else :
            $imageName = time() . '.jpg';
            $path = public_path('images');
            $post->update([
                'title' => request('title'),
                'body' => request('body'),
                'subject_id' => request('subject'),
                'price' => request('price'),
                'photo' => $imageName
            ]);
            $request->photo->move(public_path('images'), $imageName);
        endif;
        return (new PostResource($post))->additional([
            'success' => 'The post was updated'
        ]);
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
            'subject' => 'required',
            'price' => 'required'
        ]);
    }
}
