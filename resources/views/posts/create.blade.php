@extends('layouts.app')

@section('title', '新規投稿')

@section('content')
<div class="box">
<h1>
    <a href="{{ url('/') }}" class="pull-right">戻る</a>
    新規投稿
</h1>
{!! Form::open([
    'url'    => url('/posts'),
    'method' => 'post',
    'class'  => 'post-form',
    'name'   => 'form']
) !!}
{{ csrf_field() }}
<div class="row">
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
</div>
<div class="row">
    <div class="col-md-7">
        <p>
            <input type="submit" value="投稿する"  class="btn btn-primary">
        </p>
    </div>
</div>
</div>
{!! Form::close() !!}
@endsection