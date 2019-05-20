<<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card text-white bg-dark mb-3" style="max-width: 20rem;">
                <div class="card-header">Header</div>
                <div class="card-body">
                    <h4 class="card-title">Dark card title</h4>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <!-- <p class="card-text viewData">{{ viewData }}</p> -->
                    <p class="card-text viewData">{{ viewData.name }}</p>
                    <p class="card-text viewData">{{ viewData.category }}</p>
                    <p class="card-text viewData">{{ viewData.coupon_url.pc }}</p>
                    <p class="card-text viewData">{{ viewData.address }}</p>
                    <p class="card-text viewData">{{ viewData.opentime }}</p>
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
