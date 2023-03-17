@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
<h1>商品登録</h1>
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
            <form method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">名前</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="名前">
                    </div>

                    <div class="form-group">
                        <label for="code">商品コード</label>
                        <input type="text" class="form-control" id="code" name="code" placeholder="JANコード">
                    </div>

                    <div class="form-group">
                        <label for="type_id">種別</label>
                        <select class="form-control" id="type_id" name="type_id">
                            <option value="">選択してください</option>
                            @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="detail">詳細</label>
                        <input type="text" class="form-control" id="detail" name="detail" placeholder="詳細説明">
                    </div>

                    <div class="form-group">
                        <label for="quantity">在庫数</label>
                        <input type="number" class="form-control" id="quantity" name="quantity">
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">登録</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop