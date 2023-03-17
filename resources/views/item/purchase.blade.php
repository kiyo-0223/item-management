@extends('adminlte::page')

@section('title', '商品入庫')

@section('content_header')
<h1>入庫処理</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <div class="card-tools float-left">
                    <label for="type_id">商品コード入力</label>
                    <div class="input-group">
                        <!-- 検索フォーム -->
                        <form action="{{ route('purchase') }}" method="GET">
                        <!-- <div class="input-group mb-3">     -->
                        <div class="form-group">
                                <input type="text" class="form-control" name="code">
                                <button type="submit" class="btn btn-default mt-2">検索</button>
                                <button class="btn btn-default mt-2" href="/items/purchase/">クリア</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @if (!empty($code))
            @foreach ($items as $item)
            <form method="POST">
                <div class="card-body table-responsive p-0">
                    @csrf
                    <input type="hidden" name="id" value="{{ $item->id }}">

                    <table class="table table-hover text-nowrap">
                        <tr>
                            <th>ID</th>
                            <td>{{ $item->id }}</td>
                        </tr>
                        <tr>
                            <th>名前</th>
                            <td>{{ $item->name }}</td>
                        </tr>
                        <tr>
                            <th>商品コード</th>
                            <td>{{ $item->code }}</td>
                        </tr>
                        <tr>
                            <th>入庫数</th>
                            <td>
                                <input type="number" class="form-control" id="quantity" name="quantity">
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">仕入登録</button>
                </div>
            </form>
                        @endforeach
            @endif
        </div>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop