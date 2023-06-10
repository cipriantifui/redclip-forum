<template>
    <div class="pb-5">
        <div class="row">
            <div class="col-xl-2 col-lg-3 col-md-12 mb-lg-0 mb-3">
                <left-side-nav></left-side-nav>
            </div>
            <div class="col-xl-10 col-lg-9 col-md-12">
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
    import PostCard from "./post/PostCard.vue";
    import LeftSideNav from "./nav/LeftSideNav.vue";
    import PostApi from "../services/PostApi";

    export default {
        name: "Home.vue",
        components: {LeftSideNav, PostCard},
        inject: ['eventHub'],
        data() {
            return {
                posts: {},
                paginate: {},
                perPage: 5,
            }
        },

        beforeMount() {
            this.getPosts(1);
            this.eventHub.$on('addedPostEvent', () => {
                this.getPosts(1);
            })
        },
        methods: {
            getPosts(page) {
                PostApi.getPosts(page, this.perPage)
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
