<<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <!--
                <div class="card text-white bg-dark" style="width: 20rem;">
                    <img class="card-img-top viewData" :src="viewData.attributes.image_url.shop_image1" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">Card title</h4>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
                -->
                <div class="card text-white bg-dark">
                    <img class="card-img-top viewData" :src="viewData.attributes.image_url.shop_image1" width="100%" height="180" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title viewData">{{ viewData.attributes.name }}</h4>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <p class="card-text viewData">{{ viewData.attributes.pr.pr_short }}</p>
                        <a href="javascript::void(0)" class="btn btn-primary" data-toggle="modal" data-target="#detailModal">詳細</a>
                    </div>
                </div>

                <div class="card text-white bg-dark">
                    <img class="card-img-top viewData" :src="viewData.attributes2.image_url.shop_image1" width="100%" height="180" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title viewData">{{ viewData.attributes2.name }}</h4>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <p class="card-text viewData">{{ viewData.attributes2.pr.pr_short }}</p>
                        <a href="javascript::void(0)" class="btn btn-primary" data-toggle="modal" data-target="#detailModal2">詳細</a>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content text-white bg-dark viewData">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">{{ viewData.attributes.name }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#ffffff;">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <img class="card-img-top" :src="viewData.attributes.image_url.shop_image1" width="100%" height="180" alt="Card image cap">
                                <br>
                                <br>
                                <div class="shopInfo">
                                    <p class="shopInfoMessage">{{ viewData.attributes.pr.pr_long }}</p>
                                </div>
                                <div class="shopInfo">
                                    <p class="shopInfoTitle">
                                        <span class="fa fa-calendar"></span>&nbsp;店舗スケジュール:
                                    </p>
                                    <p class="shopInfoCalender">{{ viewData.attributes.opentime }}</p>
                                    <p  class="shopInfoCalender">{{ viewData.attributes.holiday }}</p>
                                </div>
                                <br>
                                <div class="shopInfo">
                                    <p class="shopInfoTitle">
                                        <span class="fa fa-money"></span>&nbsp;価格:
                                    </p>
                                    <p class="shopInfoCost"><span class="fa fa-moon-o"></span>&nbsp;夜:{{ viewData.attributes.party }}円</p>
                                    <p class="shopInfoCost"><span class="fa fa-sun-o"></span>&nbsp;昼:{{ viewData.attributes.lunch }}円</p>
                                </div>
                                <br>
                                <div class="shopInfo">
                                    <p class="shopInfoTitle">
                                        <span class="fa fa-home"></span>&nbsp;住所:
                                    </p>
                                    <p class="shopInfoAddress">&nbsp;{{ viewData.attributes.address }}</p>
                                </div>
                                <br>
                                <div class="shopInfo">
                                    <p class="shopInfoTitle">
                                        <span class="fa fa-phone"></span>&nbsp;TEL:
                                    </p>
                                    <p class="shopInfoPhone">{{ viewData.attributes.tel }}</p>
                                </div>
                                <br>
                                <p>*「予約をする」ボタンを押下すると「ぐるなび」のサイトへ移動します。</p>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">予約をする</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal2 -->
                <div class="modal fade" id="detailModal2" tabindex="-1" role="dialog" aria-labelledby="detailModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content text-white bg-dark viewData">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">{{ viewData.attributes2.name }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#ffffff;">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <img class="card-img-top" :src="viewData.attributes2.image_url.shop_image1" width="100%" height="180" alt="Card image cap">
                                <br>
                                <br>
                                <div class="shopInfo">
                                    <p class="shopInfoMessage">{{ viewData.attributes2.pr.pr_long }}</p>
                                </div>
                                <div class="shopInfo">
                                    <p class="shopInfoTitle">
                                        <span class="fa fa-calendar"></span>&nbsp;店舗スケジュール:
                                    </p>
                                    <p class="shopInfoCalender">{{ viewData.attributes2.opentime }}</p>
                                    <p  class="shopInfoCalender">{{ viewData.attributes2.holiday }}</p>
                                </div>
                                <br>
                                <div class="shopInfo">
                                    <p class="shopInfoTitle">
                                        <span class="fa fa-money"></span>&nbsp;価格:
                                    </p>
                                    <p class="shopInfoCost"><span class="fa fa-moon-o"></span>&nbsp;夜:{{ viewData.attributes2.party }}円</p>
                                    <p class="shopInfoCost"><span class="fa fa-sun-o"></span>&nbsp;昼:{{ viewData.attributes2.lunch }}円</p>
                                </div>
                                <br>
                                <div class="shopInfo">
                                    <p class="shopInfoTitle">
                                        <span class="fa fa-home"></span>&nbsp;住所:
                                    </p>
                                    <p class="shopInfoAddress">&nbsp;{{ viewData.attributes2.address }}</p>
                                </div>
                                <br>
                                <div class="shopInfo">
                                    <p class="shopInfoTitle">
                                        <span class="fa fa-phone"></span>&nbsp;TEL:
                                    </p>
                                    <p class="shopInfoPhone">{{ viewData.attributes2.tel }}</p>
                                </div>
                                <br>
                                <p>*「予約をする」ボタンを押下すると「ぐるなび」のサイトへ移動します。</p>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">予約をする</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
   export default {
       props: {
           viewData: Object,
       },
       mounted() {
           //console.log('MainPageComponent mounted.');
       },
       name:'maintenance'
   }
</script>

