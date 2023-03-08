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
                <form action="/types/type_edit/{{ $types->id }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">種別</label>
                            <input type="text" class="form-control" id="name" name="name"  value="{{ $types->name }}">
                        </div>
                    </div>
                    

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">編集</button>
                        </div>
                </form>
                    <form action="/types/type_delete/{{ $types->id }}" method="POST" onclick='return confirm("削除しますか？")'; >
                        @csrf
                        @if($items == 0)
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">削除</button>
                        </div>
                        @else
                        @endif
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
