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
                <div class="card topic-card" @click="handleTopicChoose(topic)">
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
            <div class="col-12 mt-4">
                <nav aria-label="navigation">
                    <ul class="pagination b-pagination-pills justify-content-center">
                        <li class="page-item" :class="{'active': link.active, 'disabled': link.url === null}" v-for="link in links">
                            <a class="page-link"
                                href="javascript: void(0)"
                                @click="handleNavigate(link)"
                                v-html="link.label"></a>
                        </li>
                    </ul>
                </nav>
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
            links: [],
            perPage: 12,
            currentPage: 1,
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
        this.getTopics(this.currentPage, this.selectedOption.orderByColumns);
    },
    methods: {
        getTopics(page, orderByColumns) {
            this.axios.get('/api/topics', {params: {perPage: this.perPage, page: page, orderByColumns: orderByColumns}})
                .then(response => {
                    if(response.status === 200) {
                        this.topics = response.data.data
                        this.links = response.data.meta.links
                    }
                }).catch(error => {
            });
        },
        handleNavigate(link) {
            if(link.url !== null && link.active === false) {
                let pageNumber = link.url.split("=")[1];
                this.getTopics(pageNumber, this.selectedOption.orderByColumns);
            }
        },
        handleTopicChoose(topic) {

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
.topic-card:hover {
    background: #ececec;
    cursor: pointer
}
.pagination>li>a,
.pagination>li>span {
    border: 1px solid #6c757d;
    color: #6c757d;
}
.pagination>li.active>a {
    background: #6c757d;
    border: 1px solid #6c757d;
    color: #fff;
}
.pagination>li.disabled>a {
    background: #ececec;
}
</style>
