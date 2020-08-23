@extends('layouts.app')

@section('title', $post->title.' 編集')

@section('content')
<div class="box" style="overflow-x:scroll;">
<h1>
    <a href="{{ url('/') }}" class="pull-right">戻る</a>
    記事編集
</h1>
{!! Form::open([
    'url'    => url('/posts', $post->id),
    'method' => 'patch',
    'name'   => 'form']
) !!}
{{ csrf_field() }}
<div class="row">
    <div class="col-md-7">
        <p>
            <span>タイトル（必須）</span><br>
            {!! Form::text('title', $post->title, ['placeholder' => 'title']) !!}
        </p>
        <p>
            <span>カテゴリー（必須）</span><br>
            {!! Form::select('category1_id', \App\Category::all()->pluck('category_name', 'id')->toArray(), $post->category->id, ['class' => 'form-control on-focus-select', 'placeholder' => '-- 選択 --']) !!}
        </p>
        <a type="button" class="btn btn-default btn-xs" href="{{ url('/categories/create') }}" style="font-size:12px;">
            新規カテゴリー作成
        </a>
        <br>

        {!! Form::textarea('body', $post->body, ['id' => 'body-data', 'style' => 'display:none;', 'v-pre']) !!}
        <form_edit></form_edit>
        <div class="col-md-7">
            <p>
                <input type="submit" value="更新する"  class="btn btn-primary">
            </p>
        </div>
    </div>
</div>
</div>
{!! Form::close() !!}
@endsection
