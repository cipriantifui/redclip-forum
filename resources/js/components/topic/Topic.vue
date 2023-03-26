<template>
    <div class="pb-5">
        <div class="row">
            <div class="col-12">
                <post-card :post="post" v-for="post in posts" :key="post.id"></post-card>

                <div class="col text-center mt-3">
                    <button type="button" class="btn btn-secondary" v-if="paginate.next_page_url"
                            @click="getPosts(paginate.current_page + 1)">
                        View-more
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import PostCard from "../post/PostCard.vue";
import PostApi from "../../services/PostApi";

export default {
    name: "Topic",
    components: {PostCard},
    data() {
        return {
            topicId: this.$route.params.topic_id,
            page: 1,
            perPage: 5,
            paginate: {},
            topic: {},
            posts: {}
        }
    },
    created() {
        this.$store.commit('storeIsShowHeader', true)
    },
    mounted() {
        this.topic = this.$store.getters.getTopic
        this.getPosts(this.page);
    },
    methods: {
        getPosts(page) {
            this.$store.commit('storeIsShowLoader', true)
            PostApi.getPosts(page, this.perPage, this.topicId)
                .then(response => {
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
        this.$store.commit('storeTopic', {})
    }
}
</script>

<style scoped>

</style>
