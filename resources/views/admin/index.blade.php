@extends('layouts.app')

@section('title', '管理者ページ')

@section('content_header')
<h1>
    <a href="{{ url('/posts/create') }}" class="pull-right">新規投稿</a>
    ブログ記事一覧
</h1>
@endsection

@section('content')
    <div class="box">
        <ul>
            @forelse ($posts as $post)
            <li>
                <a href="{{ action('PostsController@show', $post->id) }}">
                    {{ $post->title }}<br>
                </a>
                <span>カテゴリー１：{{ $post->category1->category_name }}</span>
                @if($post->category2)
                <span>カテゴリー２：{{ $post->category2->category_name }}</span>
                @endif
                
                <a href="{{ action('PostsController@edit', $post->id) }}">[編集]</a>
                {!! Form::model($post, [
                    'url'    => action('PostsController@destroy', $post->id),
                    'method' => 'delete',
                    'id'     => 'del-form-'.$post->id,
                    'style'  => 'display:inline;'
                ]) !!}
                {{ csrf_field() }}
                <a href="#" data-id="{{ $post->id }}" onclick="deletePost(this);">[削除]</a>
                {!! Form::close() !!}
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

{!! Form::open([
    'url'    => url('pictures'),
    'method' => 'post',
    'class'  => 'post-form',
    'name'   => 'form',
    'enctype' => 'multipart/form-data']
) !!}
{{ csrf_field() }}
    <p>
        <span>画像</span><br>
        {!! Form::file('image', ['class' => 'upload-input']) !!}
    </p>
        {!! Form::hidden('cur_url', url()->current()) !!}
    <p>
        <input type="submit" value="新規画像追加"  class="btn btn-primary">
    </p>
{!! Form::close() !!}

<h1>
    画像ファイル一覧
</h1>
    @foreach($pictures as $picture)
    <img src="{{ route('picture.response', ['name' => $picture->storage_path]) }}" / style="max-width:200px; max-height:200px;"><br>
    <span>pictures/{{ $picture->storage_path }}</span><br>
    <br>
    @endforeach
@endsection

@section('script')
<script>
    function deletePost(e) {
        'use strict';
        if (confirm('この記事を削除しますか？?')) {
            document.getElementById('del-form-' + e.detaset.id).submit();
        }
    }
</script>
@endsection