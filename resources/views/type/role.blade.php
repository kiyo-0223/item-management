@extends('adminlte::page')

@section('title', '権限編集')

@section('content_header')
<h1>権限編集</h1>
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
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>名前</th>
                            <th>権限</th>
                            <th>　　</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <form action="/types/role" method='post'>
                            @csrf
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>
                                    <div class="col-md-6">
                                        <select class="form-control" id="role" name="role{{ $user->id }}">
                                            @foreach(config('const.roles') as $key =>$label)
                                            <option value="{{ $key }}" @if($key==$user->role) selected @endif>
                                                {{ $label }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-primary">編集</button>
                                </td>
                            </tr>
                            @endforeach
                        </form>
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