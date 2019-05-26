<<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <!--
                <div class="card text-white bg-dark mb-3" style="max-width: 20rem;">
                    <div class="card-header">Header</div>
                    <div class="card-body">
                        <h4 class="card-title">Dark card title</h4>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <p class="card-text viewData">{{ viewData.name }}</p>
                        <p class="card-text viewData">{{ viewData.category }}</p>
                        <p class="card-text viewData">{{ viewData.coupon_url.pc }}</p>
                        <p class="card-text viewData">{{ viewData.address }}</p>
                        <p class="card-text viewData">{{ viewData.opentime }}</p>
                    </div>
                </div>
                -->
                <div class="card text-white bg-dark" style="width: 20rem;">
                    <img class="card-img-top viewData" :src="viewData.image_url.shop_image1" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">Card title</h4>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
                <div class="card text-white bg-dark">
                    <img class="card-img-top viewData" :src="viewData.image_url.shop_image1" width="100%" height="180" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title viewData">{{ viewData.name }}</h4>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <p class="card-text viewData">{{ viewData.pr.pr_short }}</p>
                        <a href="javascript::void(0)" class="btn btn-primary" data-toggle="modal" data-target="#detailModal">詳細</a>
                    </div>
                </div>
                <!--
                <div class="card" style="width: 20rem;">
                    <img class="card-img-top viewData" :src="viewData.image_url.shop_image1" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title viewData">{{ viewData.name }}</h4>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
                -->

                <!-- Modal -->
                <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content text-white bg-dark viewData">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">{{ viewData.name }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#ffffff;">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <img class="card-img-top" :src="viewData.image_url.shop_image1" width="100%" height="180" alt="Card image cap">
                                <br>
                                <br>
                                <p>{{ viewData.pr.pr_long }}</p>
                                <div class="shopInfo">
                                    <p class="shopInfoTitle fa fa-calendar">&nbsp;店舗スケジュール:</p>
                                    <p>{{ viewData.opentime }}</p>
                                    <p>{{ viewData.holiday }}</p>
                                </div>
                                <div class="shopInfo">
                                    <p class="shopInfoTitle fa fa-receipt">価格:</p>
                                    <p>夜:{{ viewData.party }}</p>
                                    <p>昼:{{ viewData.lunch }}</p>
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
           console.log('MainPageComponent mounted.');
       },
       name:'main-page'
   }
</script>

<!--
<script>
    export default {
        data() {
            return {
                attendances: [],
                pageCount: 1,
                endpoint: 'api/attendances?page='
            };
        },

        created() {
            this.fetch();
        },

        methods: {
            fetch(page = 1) {
                axios.get(this.endpoint + page)
                    .then(({data}) => {
                        this.attendances = data.data;
                        this.pageCount = data.meta.last_page;
                    });
            }
        }
    }
</script>
-->
