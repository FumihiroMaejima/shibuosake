@extends('master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="tab_wrap">
                <input id="tab1" type="radio" name="tab_btn" checked>
                <input id="tab2" type="radio" name="tab_btn">
                <input id="tab3" type="radio" name="tab_btn">

                <div class="tab_area">
                    <label class="tab1_label" for="tab1">tab1</label>
                    <label class="tab2_label" for="tab2">tab2</label>
                    <label class="tab3_label" for="tab3">tab3</label>
                </div>
                <div class="panel_area">
                    <div id="panel1" class="tab_panel">
                        <!-- <p>panel1panel1panel1panel1panel1</p> -->
                        <main-page></main-page>
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
