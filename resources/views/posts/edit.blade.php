@extends('layouts.app')

@section('title', $post->title.' 編集')

@section('content')
<h1>
    <a href="{{ url('/') }}" class="pull-right fs12">戻る</a>
    記事編集
</h1>
{!! Form::open([
    'url'    => url('/posts', $post->id),
    'method' => 'patch',
    'name'   => 'form']
) !!}
{{ csrf_field() }}
<div>
    <div class="col-md-7">
        <p>
            <span>タイトル（必須）</span><br>
            {!! Form::text('title', $post->title, ['placeholder' => 'title']) !!}
        </p>
        <p>
            <span>カテゴリー１（必須）</span><br>
            {!! Form::select('category1_id', \App\Category::all()->pluck('category_name', 'id')->toArray(), $post->category1->id, ['class' => 'form-control on-focus-select', 'placeholder' => '-- 選択 --']) !!}
        </p>
        <p>
            <span>カテゴリー２</span><br>
        @if ($post->category2)
            {!! Form::select('category2_id', \App\Category::all()->pluck('category_name', 'id')->toArray(), $post->category2->id, ['class' => 'form-control on-focus-select', 'placeholder' => '-- 選択 --']) !!}
        @else
            {!! Form::select('category2_id', \App\Category::all()->pluck('category_name', 'id')->toArray(), null, ['class' => 'form-control on-focus-select', 'placeholder' => '-- 選択 --']) !!}
        @endif
        </p>
        <a type="button" class="btn btn-default btn-xs" href="{{ url('/categories/create') }}" style="font-size:12px;">
            新規カテゴリー作成
        </a>
        <br>

        {!! Form::textarea('body', $post->body, ['id' => 'body-data', 'style' => 'display:none;']) !!}
        <form_edit></form_edit>
        <div class="col-md-7">
            <p>
                <input type="submit" value="更新する"  class="btn btn-primary">
            </p>
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection