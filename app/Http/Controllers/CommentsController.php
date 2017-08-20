<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Comment;
use App\Post;
use App\Http\Requests\Comment\CommentRequest;

class CommentsController extends Controller
{
    public function store(CommentRequest $request, $post_id) {
        $comment = new Comment();
        $comment->fill($request->all());
        $comment->password = bcrypt($request->get('password'));
        $post = Post::findOrFail($post_id);
        $post->comments()->save($comment);
        return redirect()->action('PostsController@show', $post->id)->with('flash_message', 'コメントを投稿しました。');
    }

    public function destroy(CommentRequest $request, $post_id, $comment_id) {
        $post = Post::findOrFail($post_id);
        if (!Auth::guard()->check()) {
            if (bcrypt($request->get('del_password')) != $post->comments()->findOrFail($comment_id)->password) {
                return redirect()->action('PostsController@show', $post->id)->with('flash_error', ['削除用パスワードが間違っています。']);
            }
        }
        $post->comments()->findOrFail($comment_id)->delete();
        return redirect()->action('PostsController@show', $post->id)->with('flash_message', 'コメントを削除しました。');
    }
}
