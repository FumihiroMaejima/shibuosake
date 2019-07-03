@extends('master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <p style="text-align:center;color:#ff0000;">maintenance page</p>
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
                        <maintenance v-bind:view-data="{{ $viewData }}"></maintenance>
                        <div class="page_change_area">
                            @if ($pageCount > 1)
                                @for ($i=1;$i<=$pageCount;$i++)
                                    @if ($i == $pageOffset)
                                        <a class="active_page_btn" href="javascript:void(0)">{{ $i }}</a>
                                    @else
                                        <a class="page_change_btn" href="/page/{{ $i }}">{{ $i }}</a>
                                    @endif
                                @endfor
                            @endif
                        </div>
                    </div>
                    <div id="panel2" class="tab_panel">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div>
                                        @foreach ($areaViewData as $area => $areaShop)
                                            <table>
                                                <tr>
                                                    <th>{{ $area }}&nbsp;&nbsp;店舗数：{{ $areaShop['shopCount'] }}</th>
                                                </tr>
                                                @foreach ($areaShop as $key => $shopInfo)
                                                    @if ($key != 'shopCount')
                                                        <tr>
                                                            <td>
                                                                <span class="inline-span col-md-4">
                                                                    <img class="target-area-shop-image" src="{{ $shopInfo['shop_image1'] }}" alt="no image">
                                                                </span>
                                                                <span class="inline-div col-md-8">
                                                                    <a class="target-area-shop-link" href="{{ $shopInfo['url'] }}" >&nbsp;&nbsp;{{ $shopInfo['name'] }}</a>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </table>
                                            <br>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="panel3" class="tab_panel">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div>
                                        @foreach ($categoryViewData as $category => $categoryShop)
                                            <table>
                                                <tr>
                                                    <th>{{ $category }}&nbsp;&nbsp;店舗数：{{ $categoryShop['shopCount'] }}</th>
                                                </tr>
                                                @foreach ($categoryShop as $key => $shopInfo)
                                                    @if ($key != 'shopCount')
                                                        <tr>
                                                            <td>
                                                                <span class="inline-span col-md-4">
                                                                    <img class="target-area-shop-image" src="{{ $shopInfo['shop_image1'] }}" alt="no image">
                                                                </span>
                                                                <span class="inline-div col-md-8">
                                                                    <a class="target-area-shop-link" href="{{ $shopInfo['url'] }}" >&nbsp;&nbsp;{{ $shopInfo['name'] }}</a>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </table>
                                            <br>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
