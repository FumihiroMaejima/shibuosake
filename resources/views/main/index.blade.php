@extends('master')

@section('content')
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <p>
            <li class="active">
                <a href="{{ route('mainPage') }}">お酒画面へ</a>
            </li>
        </p>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <main-page></main-page>
        </div>


    </div>
@endsection
