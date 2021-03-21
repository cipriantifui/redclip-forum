<template>
    <div class="pb-5">
        <div class="row">
            <div class="col-12">
                <div class="card post-card px-3 py-1 mb-2" v-for="post in posts">
                    <div class="post-user">{{post.user === null ? 'anonymous' + post.uid : post.user.name}}
                        <timeago :datetime="post.created_at"></timeago>
                    </div>
                    <h4 style="color: #1b1e21">{{ post.title }}</h4>
                    <span class="badge badge-danger" style="width: min-content">{{ post.topic.title }}</span>
                    <p class="content pt-2" v-if="post.content">
                        {{post.content}}
                    </p>
                    <p class="content pt-2" v-if="post.url_image">
                        <img :src="post.url_image" :alt="post.title">
                    </p>
                    <p class="content pt-2" v-if="post.url_video">
                        <iframe
                            :src="post.url_video"
                            width="100%"
                            height="100%"
                            frameborder="0">
                        </iframe>
                    </p>
                    <p class="post-actions">
                        <span @click="savePostVote(post.id)"><i class="fa fa-thumbs-up"></i> {{post.votes_count}} UpVotes </span>
                        <span><router-link :to="{ name: 'post-details', params: {post_id: post.id} }"
                                           class="nav-link"><i class="fa fa-comment"></i> {{post.comments_count}} Comments</router-link></span>
                    </p>
                </div>

                <button type="button" class="btn btn-secondary" v-if="paginate.next_page_url"
                        @click="getPosts(paginate.current_page+1)">View-more
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Home.vue",
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
                this.axios.get('/api/post', {params: {perPage: 4, page: page}})
                    .then(response => {
                        this.posts = page === 1 ? response.data.data : this.posts.concat(response.data.data);
                        this.paginate = response.data;
                    }).catch(error => {
                });
            },

            savePostVote(postId) {
                let url = this.$store.state.isLoggedIn ? '/api/auth/post-vote/create' : '/api/post-vote/create';

                this.axios.post(url, {
                    post_id: postId,
                    uid: this.$store.state.isLoggedIn ? null : this.$uoid,
                }).then(response => {
                    var foundIndex = this.posts.findIndex(x => x.id === postId);
                    var votes = this.posts[foundIndex].votes_count;
                    this.posts[foundIndex].votes_count = response.data.voteUp ? (votes+1) : (votes-1);
                }).catch(error => {
                    if (error.response) {
                        if (error.response.data.errors.error) {
                            this.$toaster.error(error.response.data.errors.error)
                        } else {
                            this.$toaster.error(error.response.data.errors.error)
                        }
                    }
                });
            }
        }
    }
</script>

<style scoped>
    .post-card .post-user {
        color: #6c757d;
        border-bottom: 2px dashed #ccc;
        margin-bottom: 5px;
    }

    .post-actions span {
        font-weight: bold;
        cursor: pointer;
    }

    .post-actions span:hover {
        font-size: 15px;
        color: #1b1e21;
    }

    .post-actions span a {
        display: inline;
        color: #585858;
    }
</style>
