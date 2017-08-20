@extends('layouts.app')

@section('title', '私のブログ')

@section('content_header')
<h1>
    @if (Auth::check())
    <a href="{{ url('/posts/create') }}" class="pull-right fs12">新規投稿</a>
    @endif
    ブログ記事一覧
</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
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
                    <a href="{{ action('PostsController@edit', $post->id) }}" class="fs12">[編集]</a>
                    {!! Form::model($post, [
                        'url'    => action('PostsController@destroy', $post->id),
                        'method' => 'delete',
                        'id'     => 'del-form-'.$post->id,
                        'style'  => 'display:inline;'
                    ]) !!}
                    {{ csrf_field() }}
                    <a href="#" data-id="{{ $post->id }}" onclick="deletePost(this, {{ $post->id }});" class="fs12">[削除]</a>
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
    </div>
    <div class="col-md-4">
        <div class="sidebox">
            <span style="font-weight: bold;">カテゴリー</span><br>
            <?php $categories = categories(); ?>
            @foreach($categories as $category)
            <?php $url_category = url('/')."?category=".$category->id; ?>
            <a href="{{ $url_category }}">{{ $category->category_name }}</a><br>
            @endforeach
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