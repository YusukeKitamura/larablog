<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Post;
use App\Picture;
use App\Http\Requests\Post\PostRequest;

class AdminController extends Controller
{
    public function index(Request $request) {
        $posts = Post::orderBy('created_at', 'desc');
        if ($request->get('category')) {
            $posts = $posts->where('category_id', $request->get('category'));
        }
        $posts    = $posts->paginate(10);
        $pictures = Picture::all();
        return view('admin.index', compact('posts', 'pictures'));
    }
}
