@extends('adminlte::page')

@section('title', '管理')

@section('content_header')
<h1>管理</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-10">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card card-primary">
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a class="btn btn-secondary btn-block" type="button" href="/types/type">種別登録</a>
                    <a class="btn btn-secondary btn-block" type="button"  href="/types/role">権限編集</a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop