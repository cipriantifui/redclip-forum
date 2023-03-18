<template>
    <div class="pb-5">
        <div class="row">
            <div class="col-12">
                <post-card :post="post" v-for="post in posts" :key="post.id"></post-card>

                <button type="button" class="btn btn-secondary" v-if="paginate.next_page_url"
                        @click="getPosts(paginate.current_page + 1)">
                    View-more
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import PostCard from "./Post/PostCard.vue";

    export default {
        name: "Home.vue",
        components: {PostCard},
        data() {
            return {
                posts: {},
                paginate: {},
            }
        },

        beforeMount() {
            this.getPosts(1);
        },

        methods: {
            getPosts(page) {
                this.axios.get('/api/post', {params: {perPage: 5, page: page}})
                    .then(response => {
                        this.posts = page === 1 ? response.data.data : this.posts.concat(response.data.data);
                        this.paginate = response.data;
                    }).catch(error => {
                });
            }
        }
    }
</script>

<style scoped>

</style>
