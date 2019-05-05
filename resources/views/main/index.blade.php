@extends('master')

@section('content')
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <p>
            <li class="active">
                <a href="{{ route('main') }}">出席登録画面へ</a>
            </li>
        </p>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <attendances></attendances>
        </div>
    </div>
@endsection
