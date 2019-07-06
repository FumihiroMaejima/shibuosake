<<template>
    <div class="container">
        <div class="row justify-content-center">
            <!-- tab1 shop list  -->
            <div class="col-md-12" v-if="tabCheck == 1">

                <div class="card text-white bg-dark mb-3" v-for="(restaurant, key) in viewData" v-bind:key="restaurant.id">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img class="card-img" :src="restaurant.image_url.shop_image1" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ restaurant.name }}</h5>
                                <p class="card-text">{{ restaurant.pr.pr_short }}</p>
                                <a v-on:click="attach(restaurant)" href="javascript::void(0)" class="btn btn-primary" data-toggle="modal" data-target="#detailModal">詳細</a>
                            </div>
                        </div>
                    </div>
                </div>

               <!-- modal -->
                <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content text-white bg-dark viewData">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalLongTitle">{{ title }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#ffffff;">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <img class="card-img-top" :src="shop_image2" width="100%" height="100%" alt="Card image cap">
                                <br>
                                <br>
                                <div class="shopInfo">
                                    <p class="shopInfoMessage">{{ pr_long }}</p>
                                </div>
                                <div class="shopInfo">
                                    <p class="shopInfoTitle">
                                        <span class="fa fa-calendar"></span>&nbsp;店舗スケジュール:
                                    </p>
                                    <p class="shopInfoCalender">{{ opentime }}</p>
                                    <p  class="shopInfoCalender">{{ holiday }}</p>
                                </div>
                                <br>
                                <div class="shopInfo">
                                    <p class="shopInfoTitle">
                                        <span class="fa fa-money"></span>&nbsp;価格:
                                    </p>
                                    <p class="shopInfoCost"><span class="fa fa-moon-o"></span>&nbsp;夜:{{ party }}円</p>
                                    <p class="shopInfoCost"><span class="fa fa-sun-o"></span>&nbsp;昼:{{ lunch }}円</p>
                                </div>
                                <br>
                                <div class="shopInfo">
                                    <p class="shopInfoTitle">
                                        <span class="fa fa-home"></span>&nbsp;住所:
                                    </p>
                                    <p class="shopInfoAddress">&nbsp;{{ address }}</p>
                                </div>
                                <br>
                                <div class="shopInfo">
                                    <p class="shopInfoTitle">
                                        <span class="fa fa-phone"></span>&nbsp;TEL:
                                    </p>
                                    <p class="shopInfoPhone">{{ tel }}</p>
                                </div>
                                <br>
                                <p>*「予約をする」ボタンを押下すると「ぐるなび」のサイトへ移動します。</p>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a :href="url" class="btn btn-success">予約をする</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- tab2 area list  -->
            <div class="col-md-12" v-else-if="tabCheck == 2">
                <p>area test</p>
                <!--
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
                                            <span class="inline-span">
                                                <a class="target-area-shop-link" href="{{ $shopInfo['url'] }}" >
                                                    <img class="target-area-shop-image" src="{{ $shopInfo['shop_image1'] }}" alt="no image">
                                                    &nbsp;&nbsp;{{ $shopInfo['name'] }}
                                                </a>
                                            </span>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                        <br>
                    @endforeach
                </div>
                -->
            </div>
        </div>
    </div>
</template>

<script>
   export default {
       props: {
           viewData: {
               type: Array
           },
           tabCheck: {
               type: Number
           },
       },
        data() {
            return {
                title: 'title',
                shop_image1: 'favicon.ico',
                shop_image2: 'favicon.ico',
                pr_long: 'pr_long',
                opentime: 'opentime',
                holiday: 'holiday',
                party: 'party',
                lunch: 'lunch',
                address: 'address',
                tel: 'tel',
                url: 'localhost'
            }
        },
        methods: {
            attach: function(object) {
                this.title = object.name
                this.shop_image1 = object.image_url.shop_image1
                this.shop_image2 = object.image_url.shop_image2
                this.pr_long = object.pr.pr_long
                this.opentime = object.opentime
                this.holiday = object.holiday
                this.party = object.party
                this.lunch = object.lunch
                this.address = object.address
                this.tel = object.tel
                this.url = object.url
            }
        },
       name:'maintenance'
   }
</script>

