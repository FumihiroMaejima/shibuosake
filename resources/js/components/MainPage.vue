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
                                <img class="card-img-top" :src="shop_image2" width="100%" height="100%" alt="no image">
                                <br>
                                <br>
                                <div class="shopInfo">
                                    <p class="shopInfoMessage">{{ pr_long }}</p>
                                </div>
                                <div class="shopInfo">
                                    <p class="shopInfoTitle">
                                        </span>&nbsp;店舗スケジュール:
                                    </p>
                                    <p class="shopInfoCalender">{{ opentime }}</p>
                                    <p  class="shopInfoCalender">{{ holiday }}</p>
                                </div>
                                <br>
                                <div class="shopInfo">
                                    <p class="shopInfoTitle">
                                        </span>&nbsp;価格:
                                    </p>
                                    <p class="shopInfoCost"></span>&nbsp;夜:{{ party }}円</p>
                                    <p class="shopInfoCost"></span>&nbsp;昼:{{ lunch }}円</p>
                                </div>
                                <br>
                                <div class="shopInfo">
                                    <p class="shopInfoTitle">
                                        &nbsp;住所:
                                    </p>
                                    <p class="shopInfoAddress">&nbsp;{{ address }}</p>
                                </div>
                                <br>
                                <div class="shopInfo">
                                    <p class="shopInfoTitle">
                                        &nbsp;TEL:
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
                <div class="half-chart">
                    <doughnut-chart :chart-data="doughnutAreaCollection"></doughnut-chart>
                     <input type="hidden" class="area_count_data" :name="area" :value="count" v-for="(count, area) in areaCount">
                </div>

                <div v-for="(shopData, area) in areaData">
                    <div class="list-header">{{ area }}</div>

                    <div class="card text-white bg-dark mb-3" v-for="(shopInfo, shopId) in shopData">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img class="card-img" :src="shopInfo.shop_image1" alt="no image">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <a class="target-area-shop-link" :href="shopInfo.url">
                                        <h5 class="card-title">{{ shopInfo.name }}</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- tab3 area list  -->
            <div class="col-md-12" v-else-if="tabCheck == 3">
                <div class="half-chart">
                    <doughnut-chart :chart-data="doughnutCategoryCollection"></doughnut-chart>
                     <input type="hidden" class="category_count_data" :name="category" :value="count" v-for="(count, category) in categoryCount">
                </div>

                <div v-for="(shopData, category) in categoryData">
                    <div class="list-header">{{ category }}</div>

                    <div class="card text-white bg-dark mb-3" v-for="(shopInfo, shopId) in shopData">
                        <div class="row no-gutters" v-if="shopId != 'shopCont'">
                            <div class="col-md-4">
                                <img class="card-img" :src="shopInfo.shop_image1" alt="no image">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <a class="target-area-shop-link" :href="shopInfo.url">
                                        <h5 class="card-title">{{ shopInfo.name }}</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import DoughnutChart from '../chart/DoughnutChart.js'

    export default {
        components: {
            DoughnutChart, /* <doughnut-chart></doughnut-chart> */
        },
        props: {
            viewData: {
                type: Array
            },
            areaData: {
                type: Object
            },
            categoryData: {
                type: Object
            },
            areaCount: {
                type: Object
            },
            categoryCount: {
                type: Object
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
                url: 'localhost',
                doughnutAreaCollection: {},
                doughnutCategoryCollection: {},
            }
        },
        mounted () {
            this.getAreaObjectCount()
            this.getCategoryObjectCount()
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
            },
            getAreaObjectCount () {
                var labels = []
                var dataset = []
                var loopCnt = 0
                var targetTab = 2
                var selectData = document.querySelectorAll(".area_count_data");
                loopCnt = selectData.length
                for(var i=0;i<selectData.length;i++){
                    labels.push(selectData[i].name)
                    dataset.push(selectData[i].value)
                }

                this.fillData(labels, dataset, loopCnt, targetTab)
            },
            getCategoryObjectCount () {
                var labels = []
                var dataset = []
                var loopCnt = 0
                var targetTab = 3
                var selectData = document.querySelectorAll(".category_count_data");
                loopCnt = selectData.length
                for(var i=0;i<selectData.length;i++){
                    labels.push(selectData[i].name)
                    dataset.push(selectData[i].value)
                }

                this.fillData(labels, dataset, loopCnt, targetTab)
            },
            fillData (labels, dataset, loopCnt, chartKey) {
                var dColors = []

                for (var i = 0; i < loopCnt;i++){
                    var code = i * 40
                    //dColors.push('rgba(255,'+code+','+code+',0.4)')
                    dColors.push('rgba('+code+',255,'+code+',0.5)')
                }

                if(chartKey == 2){
                    this.doughnutAreaCollection = {
                        labels: labels,
                        datasets: [{
                            data: dataset,
                            backgroundColor: dColors
                        }],
                        options: {
                            responsive: true,
                            maintainAspectRatio: false
                        }
                    }
                }
                else{
                    this.doughnutCategoryCollection = {
                        labels: labels,
                        datasets: [{
                            data: dataset,
                            backgroundColor: dColors
                        }]
                    }
                }

            }
        },
       name:'main-page'
   }
</script>

