@extends('adminlte::page')

@section('title', '商品編集')

@section('content_header')
<h1>商品編集 ID:{{$items->id}}</h1>
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
            <form action="/items/edit/{{ $items->id }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">名前</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $items->name }}">
                    </div>

                    <div class="form-group">
                        <label for="code">商品コード</label>
                        <input type="text" class="form-control" id="code" name="code" value="{{ $items->code }}">
                    </div>

                    <div class="form-group">
                        <label for="type_id">種別</label>
                        <select class="form-control" id="type_id" name="type_id">
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                    </div>

                    <div class="form-group">
                        <label for="detail">詳細</label>
                        <input type="text" class="form-control" id="detail" name="detail" value="{{ $items->detail }}">
                    </div>

                    <div class="form-group">
                        <label for="quantity">在庫数</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $items->quantity }}">
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">登録</button>
                </div>
            </form>
            <form action="/items/delete/{{ $items->id }}" method="POST" onclick='return confirm("削除しますか？")' ;>
                @csrf
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">削除</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop