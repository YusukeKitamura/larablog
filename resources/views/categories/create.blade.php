@extends('layouts.app')

@section('title', '新規カテゴリー追加')

@section('content')
<h1>
    <a href="javascript:history.back()" class="pull-right fs12">戻る</a>
    新規カテゴリー追加
</h1>
{!! Form::open([
    'url'    => url('/categories'),
    'method' => 'post',
    'class'  => 'post-form',
    'name'   => 'form']
) !!}
{{ csrf_field() }}
    <p>
        <span>カテゴリー名（必須）</span><br>
        {!! Form::text('category_name', null, ['placeholder' => 'タイトル']) !!}
    </p>
        {!! Form::hidden('prev_url', url()->previous()) !!}
    <p>
        <input type="submit" value="カテゴリー追加"  class="btn btn-primary">
    </p>
{!! Form::close() !!}
@endsection