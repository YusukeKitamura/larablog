@extends('layouts.app')

@section('title', $post->title)

@section('content')
<h1>
    <a href="{{ url('/') }}" class="pull-right fs12">戻る</a>
    {{ $post->title }}
</h1>
<span style="font-weight:bold;">カテゴリー</span>
<p>
    {{ $post->category1->category_name }}
    @if($post->category2)
    {{ '　'.$post->category2->category_name }}
    @endif
    </p>
<span style="font-weight:bold;">投稿日時</span>
<p>{{ $post->created_at }}</p>
    <div id="body-data" style="display:none;">{{$post->body}}</div>
    <show_post></show_post>
    @if (Auth::check())
    <a href="{{ action('PostsController@edit', $post->id) }}" class="fs12">[編集]</a><br>
    @endif

<span style="font-weight:bold;">コメント</span>
<ul>
    @forelse ($post->comments as $comment)
    <p>
        {{ $comment->name }}
    </p>
    <p>
        {{ $comment->body }}
    </p>
    {!! Form::model($comment, [
        'url'    => action('CommentsController@destroy', [$post->id, $comment->id]),
        'method' => 'delete',
        'id'     => 'del-form-'.$comment->id,
        'style'  => 'display:inline;'
    ]) !!}
    {{ csrf_field() }}

    @if (!Auth::check())
        {!! Form::password('del_password', null, ['placeholder' => '削除用パスワード']) !!}
    @endif

    <a href="#" data-id="{{ $comment->id }}" onclick="deleteComment(this, {{ $comment->id }});" class="fs12">[コメントを削除する]</a>
    {!! Form::close() !!}
    @empty
    <li>まだコメントはありません</li>
    @endforelse 
</ul>
<h2>新規コメント</h2>

<form method="post" action="{{ action('CommentsController@store', $post->id) }}">
{{ csrf_field() }}
    <p>
        {!! Form::text('name', null, ['placeholder' => '名前']) !!}
    </p>
    <p>
        {!! Form::text('body', null, ['placeholder' => '本文']) !!}
    </p>
    <p>
        {!! Form::password('password', null, ['placeholder' => 'パスワード（英数字16文字以内）']) !!}
    </p>
    <p>
        <input type="submit" value="投稿する"  class="btn btn-primary">
    </p>
</form>

<script>
    function deleteComment(e, id) {
        'use strict';
        if (confirm('このコメントを削除しますか？')) {
            //console.log(e.detaset);
            document.getElementById('del-form-' + id).submit();
        }
    }
</script>
@endsection
