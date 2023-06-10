<template>
    <div class="pb-5">
        <div class="row">
            <div class="col-12" v-if="posts.length > 0">
                <post-card :post="post" v-for="post in posts" :key="post.id"></post-card>

                <div class="col text-center mt-3">
                    <button type="button" class="btn btn-secondary" v-if="paginate.next_page_url"
                            @click="getPosts(paginate.current_page + 1)">
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

export default {
    name: "Topic",
    components: {PostCard},
    inject: ['eventHub'],
    data() {
        return {
            topicId: this.$route.params.topic_id,
            page: 1,
            perPage: 5,
            paginate: {},
            topic: {},
            posts: {},
            isLoaded: false
        }
    },
    created() {
        this.$store.commit('storeIsShowHeader', true)
        this.$store.commit('selectDiscussionTag', this.$store.getters.getTopic)
        this.topic = this.$store.getters.getTopic
        this.getPosts(this.page)
    },
    mounted() {
        this.eventHub.$on('addedPostEvent', () => {
            this.getPosts(1);
        })
    },
    methods: {
        getPosts(page) {
            this.$store.commit('storeIsShowLoader', true)
            PostApi.getPosts(page, this.perPage, this.topicId)
                .then(response => {
                    this.isLoaded = true;
                    this.posts = page === 1 ? response.data.data : this.posts.concat(response.data.data);
                    this.paginate = response.data;
                })
                .finally(() => {
                    this.$nextTick(() => {
                        this.$store.commit('storeIsShowLoader', false)
                    })
                })
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
