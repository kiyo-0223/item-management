@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
<h1>商品一覧</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <label for="type_id">商品検索</label>
                    <div class="input-group">
                        <!-- 検索フォーム -->
                        <form action="{{ route('index') }}" method="GET">
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ $keyword }}" name="keyword" placeholder="キーワードを入力">
                            </div>
                    </div>
                    <!--プルダウンカテゴリ選択-->
                    <div class="form-group">
                        <select class="form-control" id="type_id" name="typesId">
                            <option value="">選択してください</option>

                            @foreach($types as $type)
                            <option value="{{ $type->id}}" @if($typeId==$type->id) selected @endif>
                                {{ $type->name }}
                            </option>
                            @endforeach
                        </select>
                        <div>
                            <button type="submit" class="btn btn-default mt-2">検索</button>
                            <button class="btn btn-default mt-2" href="/items/index/">クリア</button>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>名前</th>
                                <th>商品コード</th>
                                <th>種別</th>
                                <th>詳細</th>
                                <th>在庫数</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->code }}</td>
                                <td>{{ $item->type_name }}</td>
                                <td>{{ $item->detail }}</td>
                                <td>{{ $item->quantity }}</td>
                                @can('admin')
                                <td><a href="/items/edit/{{$item->id}}">編集</a></td>
                                @endcan
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @stop

    @section('css')
    @stop

    @section('js')
    @stop