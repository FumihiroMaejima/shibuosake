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
            <div class="tab_wrap">
                <div class="tab_area">
                    <label class="tab1_label" for="tab1">tab1</label>
                    <label class="tab2_label" for="tab2">tab2</label>
                    <label class="tab3_label" for="tab3">tab3</label>
                </div>
                <div class="panel_area">
                    <div id="panel1" class="tab_panel">
                        <p>panel1</p>
                    </div>
                    <div id="panel2" class="tab_panel">
                        <p>panel2</p>
                    </div>
                    <div id="panel3" class="tab_panel">
                        <p>panel3</p>
                    </div>
                </div>
            </div>
            <main-page></main-page>
        </div>


    </div>
@endsection
