@extends('layouts.app')

@section('title', 'あるWebプログラマの修行日記 Ver.2')

@section('content')
    <div class="box" style="margin-bottom: 10px; background-color: rgba(255, 255, 200, 0.85);
    @if (Auth::check())
    height: 80px;
    @endif
    ">
        <h1 style="border-bottom: none;">
        ブログ記事一覧
        </h1>
        @if (Auth::check())
        <h1 style="border-bottom: none;">
            <a href="{{ url('/posts/create') }}" class="pull-right">新規投稿</a>
        </h1>
        @endif
    </div>
    <div class="box">
        <ul>
            @forelse ($posts as $post)
            <li>
                <a href="{{ action('PostsController@show', $post->id) }}" style="font-weight: bold;">
                    {{ $post->title }}
                </a><br>
                <span style="font-weight: bold;">
                    カテゴリー：{{ $post->category1->category_name }}
                    @if($post->category2)
                    {{ '　'.$post->category2->category_name }}
                    @endif
                </span>
                <br><span style="font-weight: bold;">投稿日時：{{ $post->created_at }}</span>
                <p>{{ mb_substr($post->body, 0, 100).'・・・' }}
                <a href="{{ action('PostsController@show', $post->id) }}">
                    全文を読む
                </a>
                </p>
                
                @if (Auth::check())
                <a href="{{ action('PostsController@edit', $post->id) }}">[編集]</a>
                {!! Form::model($post, [
                    'url'    => action('PostsController@destroy', $post->id),
                    'method' => 'delete',
                    'id'     => 'del-form-'.$post->id,
                    'style'  => 'display:inline;'
                ]) !!}
                {{ csrf_field() }}
                <a href="#" data-id="{{ $post->id }}" onclick="deletePost(this, {{ $post->id }});">[削除]</a>
                {!! Form::close() !!}
                @endif
            </li>
            @empty
            <li>まだ投稿はありません</li>
            @endforelse 
        </ul>
        <div class="box-footer">
            <div class="table-pager text-right">
                @if ($posts->hasPages())
                    {!! $posts->render() !!}
                @elseif ($posts->total())
                <ul class="pagination">
                <li class="disabled"><span>&laquo;</span></li>
                <li class="active"><span>1</span></li>
                <li class="disabled"><span>&raquo;</span></li>
                </ul>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    function deletePost(e, id) {
        'use strict';
        if (confirm('この記事を削除しますか？')) {
            document.getElementById('del-form-' + id).submit();
        }
    }
</script>
@endsection
