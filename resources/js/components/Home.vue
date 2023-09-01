<template>
    <div class="pb-5">
        <div class="row">
            <div class="col-xl-2 col-lg-3 col-md-12 mb-lg-0 mb-3">
                <left-side-nav></left-side-nav>
            </div>
            <div class="col-xl-10 col-lg-9 col-md-12">
                <post-card :post="post" v-for="post in posts"  :key="post.id"></post-card>

                <div class="col text-center mt-3">
                    <button type="button" class="btn btn-secondary" v-if="paginate.next !== null"
                            @click="getPostLinks(paginate.next)">
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
                meta: {},
                perPage: 5,
            }
        },

        beforeMount() {
            this.getPosts(1, this.perPage);
            this.eventHub.$on('addedPostEvent', (data) => {
                this.posts.unshift(data.post)
            })
        },
        methods: {
            getPosts(page, perPage) {
                PostApi.getPosts(page, perPage)
                    .then(response => {
                        let responseData = response.data
                        if(responseData !== undefined) {
                            this.processPostResponse(responseData)
                        }
                    }).catch(error => {});
            },
            getPostLinks(links) {
                PostApi.getPostLinks(links, this.perPage).then(response => {
                    let responseData = response.data
                    if(responseData !== undefined) {
                        this.processPostResponse(responseData)
                    }
                }).catch(error => {});
            },
            processPostResponse(response) {
                this.paginate = response.links;
                this.meta = response.meta;
                this.posts = this.meta.current_page === 1 ? response.data : this.posts.concat(response.data);
            }
        }
    }
</script>

<style scoped>

</style>
