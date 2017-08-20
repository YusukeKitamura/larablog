@extends('layouts.app')

@section('title', '新規投稿')

@section('style')
<style>
html, body, #editor {
  margin: 0;
  height: 100%;
  font-family: 'Helvetica Neue', Arial, sans-serif;
  color: #333;
}

textarea, #editor div {
  display: inline-block;
  width: 49%;
  height: 100%;
  vertical-align: top;
  box-sizing: border-box;
  padding: 0 20px;
}

textarea {
  border: none;
  border-right: 1px solid #ccc;
  resize: none;
  outline: none;
  background-color: #f6f6f6;
  font-size: 14px;
  font-family: 'Monaco', courier, monospace;
  padding: 20px;
}

code {
  color: #f66;
}
</style>
@endsection

@section('content')
<h1>
    <a href="{{ url('/') }}" class="pull-right fs12">戻る</a>
    新規投稿
</h1>
{!! Form::open([
    'url'    => url('/posts'),
    'method' => 'post',
    'class'  => 'post-form',
    'name'   => 'form']
) !!}
{{ csrf_field() }}
<div>
    <div class="col-md-10">
        <p>
            <span>タイトル（必須）</span><br>
            {!! Form::text('title', null, ['placeholder' => 'タイトル']) !!}
        </p>

        <p>
            <span>カテゴリー１（必須）</span><br>
            {!! Form::select('category1_id', \App\Category::all()->pluck('category_name', 'id')->toArray(), null, ['class' => 'form-control on-focus-select', 'placeholder' => '-- 選択 --']) !!}
        </p>

        <p>
            <span>カテゴリー２</span><br>
            {!! Form::select('category2_id', \App\Category::all()->pluck('category_name', 'id')->toArray(), null, ['class' => 'form-control on-focus-select', 'placeholder' => '-- 選択 --']) !!}
        </p>
        <a type="button" class="btn btn-default btn-xs" href="{{ url('/categories/create') }}" style="font-size:12px;">
            新規カテゴリー作成
        </a>
        <br>
        <form_create></form_create>
    </div>
    <div class="col-md-7">
        <p>
            <input type="submit" value="投稿する"  class="btn btn-primary">
        </p>
    </div>
</div>
{!! Form::close() !!}
@endsection