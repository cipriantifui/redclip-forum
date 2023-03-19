<template>
    <div class="pb-5">
        <div class="row">
            <div class="col-12">
                <left-side-nav :is-show-in-top="true"></left-side-nav>
            </div>
            <div class="col-12 mt-3">
                <order-drop-down :options="orderOptions" @selectedOption="selectOrderOption"></order-drop-down>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mt-3" v-for="topic in topics">
                <div class="card topic-card">
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <p style="font-size:14px" class="mb-2"><strong>{{topic.title}}</strong></p>
                            <footer class="blockquote-footer" style="font-size:12px">
                                <i class="fa fa-comments" aria-hidden="true"></i>
                                <strong>{{topic.posts_count}}</strong> posts
                            </footer>
                            <footer class="blockquote-footer" style="font-size:12px" v-show="topic.posts_count > 0">
                                <i class="fa fa-comment" aria-hidden="true"></i>
                                <cite title="Source Title">{{topic.last_post_user }} {{topic.last_post_data}}</cite>
                            </footer>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import LeftSideNav from "../nav/LeftSideNav.vue";
import OrderDropDown from "../filters/OrderDropDown.vue";

export default {
    name: "Topics",
    components: {OrderDropDown, LeftSideNav},
    data() {
        return {
            topics: [],
            orderOptions: [
                {name: 'Top', orderByColumns: ['posts_count','desc']},
                {name: 'Newest', orderByColumns: ['created_at','desc']},
                {name: 'Oldest', orderByColumns: ['created_at','asc']},
            ],
            selectedOption: {}
        }
    },
    watch: {
        topics(newVal) {
            this.topics.forEach(topic => {
                let lastPost = topic.posts.length > 0 ? topic.posts[topic.posts.length -1] : null
                if(lastPost) {
                    topic.last_post_data = lastPost.date_ago
                    topic.last_post_user = lastPost.user ? lastPost.user.name : 'anonimus'+lastPost.uid
                }
            })
        }
    },
    mounted() {
        this.getTopics(1, this.selectedOption.orderByColumns);
    },
    methods: {
        getTopics(page, orderByColumns) {
            this.axios.get('/api/topics', {params: {perPage: 5, page: page, orderByColumns: this.selectedOption.orderByColumns}})
                .then(response => {
                    if(response.status === 200) {
                        this.topics = response.data.data
                    }
                }).catch(error => {
            });
        },
        selectOrderOption(data) {
            this.selectedOption = data.option
            if(data.isChoose) {
                this.getTopics(1, this.selectedOption.orderByColumns);
            }
        }
    }
}
</script>

<style scoped>
.topic-card {
    min-height: 130px;
}
</style>
