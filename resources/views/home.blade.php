@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-body">
                    ログインしました。
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function jumpPage(){
        location.href = "{{ url('/') }}";
    }

    setTimeout("jumpPage()",2000);
</script>
@endsection