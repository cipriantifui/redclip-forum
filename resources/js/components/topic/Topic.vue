<template>
    <div class="pb-5">
        <div class="row">
            <div class="col-12">
                <left-side-nav :is-show-in-top="true"></left-side-nav>
            </div>
            <div class="col-12 mt-3" v-if="posts.length > 0">
                <post-card :post="post" v-for="post in posts" :key="post.id"></post-card>

                <div class="col text-center mt-3">
                    <button type="button" class="btn btn-secondary" v-if="paginate.next !== null"
                            @click="getPostLinks(paginate.next)">
                        View-more
                    </button>
                </div>
            </div>
            <div class="col-12 text-center mt-3 no-discussion-box"
                 v-else-if="isLoaded">It looks as though there are no discussions here.</div>
        </div>
    </div>
</template>

<script>
import PostCard from "../post/PostCard.vue";
import PostApi from "../../services/PostApi";
import LeftSideNav from "../nav/LeftSideNav.vue";

export default {
    name: "Topic",
    components: {PostCard, LeftSideNav},
    inject: ['eventHub'],
    data() {
        return {
            topicId: this.$route.params.topic_id,
            page: 1,
            perPage: 5,
            paginate: {},
            meta: {},
            topic: {},
            posts: {},
            isLoaded: false
        }
    },
    created() {
        this.$store.commit('showHeaderTopicPage', true)
        this.$store.commit('selectDiscussionTag', this.$store.getters.getTopic)
        this.topic = this.$store.getters.getTopic
        this.getPosts(this.page)
    },
    mounted() {
        this.eventHub.$on('addedPostEvent', (data) => {
            this.posts.unshift(data.post)
        })
    },
    methods: {
        getPosts(page) {
            this.$store.commit('storeIsShowLoader', true)
            PostApi.getPosts(page, this.perPage, this.topicId)
                .then(response => {
                    this.isLoaded = true;
                    let responseData = response.data
                    if(responseData !== undefined) {
                        this.processPostResponse(responseData)
                    }
                })
                .finally(() => {
                    this.$nextTick(() => {
                        this.$store.commit('storeIsShowLoader', false)
                    })
                })
        },
        getPostLinks(link) {
            PostApi.getPostLinks(link, this.perPage, this.topicId)
                .then(response => {
                    this.isLoaded = true;
                    let responseData = response.data
                    if(responseData !== undefined) {
                        this.processPostResponse(responseData)
                    }
                })
                .finally(() => {
                    this.$nextTick(() => {
                        this.$store.commit('storeIsShowLoader', false)
                    })
                })
        },
        processPostResponse(response) {
            this.paginate = response.links;
            this.meta = response.meta;
            this.posts = this.meta.current_page === 1 ? response.data : this.posts.concat(response.data);
        }
    },
    destroyed() {
        this.$store.commit('storeIsShowHeader', false)
    }
}
</script>

<style scoped>
.no-discussion-box {
    font-size: 18px;
}
</style>
