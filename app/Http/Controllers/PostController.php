<?php

namespace App\Http\Controllers;
use App\Models\Post;
#use App\Http\Controllers\Inertia;
use Inertia\Inertia;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return Inertia::render('Post/Index', ['posts' => $posts]);
    }
    
    public function create()
    {
        return Inertia::render('Post/Create');
    }
    
    public function store(Request $request)
    {
        $post = new Post($request->all());
        # Si no funca  $request::all()
        $post->save();
        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back();
    }
    
    public function edit(Post $post)
    {
        return Inertia::render('Post/Create', ['post' => $post, 'isUpdating' => true]);
    }

    public function update(Request $request, Post $post)
    {
    $post->update($request->all());
        # if $request->all() fails try $request::all()
        return redirect()->route('posts.index');
    }
}



