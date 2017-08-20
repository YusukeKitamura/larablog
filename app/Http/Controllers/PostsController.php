<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Http\Requests\Post\PostRequest;

class PostsController extends Controller
{
    public function index(Request $request) {
        $posts = Post::orderBy('created_at', 'desc');
        if ($request->get('category')) {
            $posts = $posts->where(function($query){
                        $query->orWhere('category1_id', $request->get('category'))
                              ->orWhere('category2_id', $request->get('category'));
                        });
        }
        $posts = $posts->paginate(10);
        return view('posts.index')->with('posts', $posts);
    }

    public function show($id) {
        $post = Post::findOrFail($id);
        return view('posts.show')->with('post', $post);
    }

    public function create() {
        return view('posts.create');
    }

    public function edit($id) {
        $post = Post::findOrFail($id);
        return view('posts.edit')->with('post', $post);
    }

    public function store(PostRequest $request) {
        $post = new Post();
        $post->fill($request->all());
        $post->save();
        return redirect('/')->with('flash_message', 'Post added!');
    }

    public function update(PostRequest $request, $id) {
        $post = Post::findOrFail($id);
        $post->fill($request->all());
        $post->save();
        return redirect('/')->with('flash_message', 'Post updated!');
    }

    public function destroy($id) {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect('/')->with('flash_message', 'Post deleted!');
    }
}