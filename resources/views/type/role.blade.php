@extends('adminlte::page')

@section('title', '権限編集')

@section('content_header')
<h1>権限編集</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-10">
        <div class="card card-primary">

            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>名前</th>
                            <th>権限</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->role }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">編集</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop