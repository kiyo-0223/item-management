@extends('adminlte::page')

@section('title', '種別編集')

@section('content_header')
    <h1>種別編集 ID:{{$types->id}}</h1>
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
                            <label for="type">種別</label>
                            <input type="number" class="form-control" id="type" name="type" value="{{ $items->name }}">
                        </div>
                    </div>
                    

                    <div class="btn-toolbar">
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">編集</button>
                        </div>
                </form>
                    <form action="/type/delete/{{ $types->id }}" method="POST" onclick='return confirm("削除しますか？")'; >
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
