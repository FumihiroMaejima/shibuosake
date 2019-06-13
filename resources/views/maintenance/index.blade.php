@extends('master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="tab_wrap">
                <input id="tab1" type="radio" name="tab_btn" checked>
                <input id="tab2" type="radio" name="tab_btn">
                <input id="tab3" type="radio" name="tab_btn">

                <div class="tab_area">
                    <label class="tab1_label fa fa-beer" for="tab1">&nbsp;osake</label>
                    <label class="tab2_label fa fa-edit" for="tab2">&nbsp;tab2</label>
                    <label class="tab3_label fa fa-user" for="tab3">&nbsp;tab3</label>
                </div>
                <div class="panel_area">
                    <div id="panel1" class="tab_panel">
                        <main-page v-bind:view-data="{{ $viewData }}"></main-page>
                        <main-page v-bind:view-data="{{ $viewData }}"></main-page>
                    </div>
                    <div id="panel2" class="tab_panel">
                        <p>panel2panel2panel2panel2panel2</p>
                    </div>
                    <div id="panel3" class="tab_panel">
                        <p>panel3panel3panel3panel3panel3</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
