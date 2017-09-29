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
            $posts = $posts->where(function($query) use ($request) {
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
        if (!\Auth::check()) {
            return redirect('/');
        }
        return view('posts.create');
    }

    public function edit($id) {
        if (!\Auth::check()) {
            return redirect('/');
        }
        $post = Post::findOrFail($id);
        return view('posts.edit')->with('post', $post);
    }

    public function store(PostRequest $request) {
        if (!\Auth::check()) {
            return redirect('/');
        }
        $post = new Post();
        $post->fill($request->all());
        $post->save();
        return redirect('/')->with('flash_message', '投稿しました!');
    }

    public function update(PostRequest $request, $id) {
        if (!\Auth::check()) {
            return redirect('/');
        }
        $post = Post::findOrFail($id);
        $post->fill($request->all());
        $post->save();
        return redirect('/')->with('flash_message', '投稿を更新しました!');
    }

    public function destroy($id) {
        if (!\Auth::check()) {
            return redirect('/');
        }
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect('/')->with('flash_message', '投稿を削除しました!');
    }
}
