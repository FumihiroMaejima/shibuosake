<<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Osake Component</div>

                    <div class="card-body">
                        I'm an Osake component.
                    </div>

                    <div class="card-footer">Osake Component Footer</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
   export default {

       data() {
           return {
               body: 'Hello Osake!'
           }
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
