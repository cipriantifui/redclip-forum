<template>
    <div class="pb-5">
        <div class="row">
            <div class="col-xl-2 col-lg-3 col-md-12 mb-lg-0 mb-3">
                <left-side-nav></left-side-nav>
            </div>
            <div class="col-xl-10 col-lg-9 col-md-12">
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="row">
                            <div class="col">
                                <order-drop-down :options="orderOptions" @selectedOption="selectOrderOption"></order-drop-down>
                            </div>
                            <div class="col text-right">
                                <b-button @click="refresh"><i class="fa fa-refresh" aria-hidden="true"></i></b-button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12" v-show="isLoading">
                        <loader :custom-class="'text-black'"></loader>
                    </div>
                    <div class="col-12" v-show="isLoading === false">
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
        </div>
    </div>
</template>

<script>
    import PostCard from "./post/PostCard.vue";
    import LeftSideNav from "./nav/LeftSideNav.vue";
    import PostApi from "../services/PostApi";
    import OrderDropDown from "./filters/OrderDropDown.vue";
    import Loader from "./common/Loader.vue";

    export default {
        name: "Home.vue",
        components: {Loader, OrderDropDown, LeftSideNav, PostCard},
        inject: ['eventHub'],
        data() {
            return {
                posts: {},
                paginate: {},
                meta: {},
                perPage: 5,
                isLoading: false,
                orderOptions: [
                    {name: 'Top', orderByColumns: ['comments_count','desc'], selected: false},
                    {name: 'Newest', orderByColumns: ['created_at','desc'], selected: true},
                    {name: 'Oldest', orderByColumns: ['created_at','asc'], selected: false},
                ],
                selectedOrderOption: null
            }
        },
        beforeMount() {
            this.eventHub.$on('addedPostEvent', (data) => {
                this.posts.unshift(data.post)
            })
        },
        methods: {
            refresh() {
                this.posts = {};
                this.getPosts(1, this.perPage, this.selectedOrderOption.orderByColumns);
            },
            selectOrderOption(data) {
                this.selectedOrderOption = data.option
                this.getPosts(1, this.perPage, this.selectedOrderOption.orderByColumns);
            },
            getPosts(page, perPage, selectedOption) {
                this.isLoading = true;
                PostApi.getPosts(page, perPage, null, selectedOption)
                    .then(response => {
                        let responseData = response.data
                        if(responseData !== undefined) {
                            this.processPostResponse(responseData)
                        }
                    }).catch(error => {})
                    .finally(() => {
                        this.isLoading = false
                    });
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
