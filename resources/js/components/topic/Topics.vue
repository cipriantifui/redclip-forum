<template>
    <div class="pb-5">
        <div class="row">
            <div class="col-12">
                <left-side-nav :is-show-in-top="true"></left-side-nav>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mt-3" v-for="topic in topics">
                <div class="card">
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <p style="font-size:14px"><strong>{{topic.title}}</strong></p>
                            <footer class="blockquote-footer" style="font-size:12px">Someone famous in <cite title="Source Title">Source Title</cite></footer>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import LeftSideNav from "../nav/LeftSideNav.vue";

export default {
    name: "Topics",
    components: {LeftSideNav},
    data() {
        return {
            topics: []
        }
    },
    beforeMount() {
        this.getTopics(1);
    },
    methods: {
        getTopics(page) {
            this.axios.get('/api/topics', {params: {perPage: 5, page: page}})
                .then(response => {
                    if(response.status === 200) {
                        this.topics = response.data.data
                    }
                }).catch(error => {
            });
        }
    }
}
</script>

<style scoped>

</style>
