<template>
    <div>
        <!-- <div class="card" v-for="attendance in attendances"> -->
        <div class="card">
            <div class="card-header">
                <span class="fa fa-user" id="start"></span>
                 <!-- {{ attendance.name }} <label id="started">さん</label> -->
            </div>
            <div class="card-body">
                <strong>本日の意気込み</strong>
                <!-- <p>{{ attendance.body }}</p> -->
            </div>
            <div class="card-footer">
                <!-- <span class="fa fa-calendar" id="visit"></span> {{ attendance.date }} | -->
                <span class="fa fa-flag" id="comment"></span>
                <!-- <a href="#" id="comments" @click="report(attendance.id)">Report</a> -->
            </div>
        </div>
        <paginate
                :page-count="pageCount"
                :click-handler="fetch"
                :prev-text="'Prev'"
                :next-text="'Next'"
                :container-class="'pagination'">
        </paginate>
    </div>
</template>

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
