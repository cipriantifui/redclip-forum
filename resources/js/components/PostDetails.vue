<template>
    <div class="pb-5">
        <div class="row">
            <div class="col-12">
                <div class="card post-card px-3 py-1 mb-2" v-if="post">
                    <div class="post-user">{{post.user === null ? 'anonymous' + post.uid : post.user.name}}
                        <timeago :datetime="post.created_at"></timeago>
                    </div>
                    <h4 style="color: #1b1e21">{{ post.title }}</h4>
                    <span class="badge badge-danger topic-badge">{{ post.topic.title }}</span>
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
                            height="200%"
                            frameborder="0">
                        </iframe>
                    </p>
                    <p class="post-actions">
                        <span @click="savePostVote(post.id)"><i class="fa fa-thumbs-up"></i> {{post.votes_count}} UpVotes </span>
                        <span><i class="fa fa-comment"></i> {{post.comments_count}} Comments</span>
                    </p>

                    <p class="comment">
                        Comment as {{this.$store.state.user ? this.$store.state.user.name : 'anonymous'+this.$uoid}}
                        <textarea rows="5" class="form-control mb-2" placeholder="What are your thoughts?"
                                  v-model="content"></textarea>
                        <button type="button" class="btn btn-secondary float-right" @click="saveComment(post.id)">
                            Comment
                        </button>
                    </p>

                    <div class="card comment-card px-3 py-1 mb-2" v-for="(comment, commentKey) in post.comments">
                        <div class="comment-user">{{comment.user === null ? 'anonymous' + comment.uid :
                            comment.user.name}}
                            <timeago :datetime="comment.created_at"></timeago>
                        </div>
                        <p class="content pt-2">
                            {{comment.content}}
                        </p>
                        <p class="comment-actions">
                            <span @click="saveCommentLike(comment.id, commentKey)"><i class="fa fa-thumbs-up"></i> {{comment.likes_count}} UpVotes </span>
                            <span @click="toggleShow(commentKey)"><i class="fa fa-comment"></i> Reply</span>
                        </p>

                        <p class="comment" v-show="isShow(commentKey)">
                            <textarea rows="3" class="form-control mb-2" placeholder="What are your thoughts?"
                                      v-model="reply"></textarea>
                            <button type="button" class="btn btn-secondary btn-sm float-right" @click="saveComment(post.id, comment.id)">
                                Reply
                            </button>
                            <button type="button" class="btn btn-danger btn-sm float-right mr-2" @click="toggleShow(-1)">
                                Cancel
                            </button>
                        </p>

                        <div class="card comment-card px-3 py-1 mb-2" v-for="(reply, replyKey) in comment.replies">
                            <div class="comment-user">{{reply.user === null ? 'anonymous' + reply.uid :
                                reply.user.name}}
                                <timeago :datetime="reply.created_at"></timeago>
                            </div>
                            <p class="content pt-2">
                                {{reply.content}}
                            </p>
                            <p class="comment-actions">
                                <span @click="saveCommentLike(reply.id, commentKey, replyKey)"><i
                                    class="fa fa-thumbs-up"></i> {{reply.likes_count}} UpVotes </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "PostDetails.vue",
        data() {
            return {
                post: null,
                content: null,
                reply: null,
                activeKey: -1,
            }
        },
        beforeMount() {
            this.showPost();
        },
        methods: {
            showPost() {
                this.axios.get('/api/post/' + this.$route.params.post_id)
                    .then(response => {
                        this.post = response.data;
                    }).catch(error => {
                });
            },

            savePostVote(postId) {
                let url = this.$store.state.isLoggedIn ? '/api/auth/post-vote/create' : '/api/post-vote/create';

                this.axios.post(url, {
                    post_id: postId,
                    uid: this.$store.state.isLoggedIn ? null : this.$uoid,
                }).then(response => {
                    var votes = this.post.votes_count;
                    this.post.votes_count = response.data.voteUp ? (votes + 1) : (votes - 1);
                }).catch(error => {
                    if (error.response) {
                        if (error.response.data.errors.error) {
                            this.$toaster.error(error.response.data.errors.error)
                        } else {
                            this.$toaster.error(error.response.data.errors.error)
                        }
                    }
                });
            },

            saveCommentLike(commentId, commentKey, replyKey = null) {
                let url = this.$store.state.isLoggedIn ? '/api/auth/comment-like/create' : '/api/comment-like/create';
                // var votes = this.post.comments[commentKey].likes_count;
                // console.log(votes);
                this.axios.post(url, {
                    comment_id: commentId,
                    uid: this.$store.state.isLoggedIn ? null : this.$uoid,
                }).then(response => {
                    if(replyKey !== null){
                        let votes = this.post.comments[commentKey].replies[replyKey].likes_count;
                        this.post.comments[commentKey].replies[replyKey].likes_count = response.data.voteUp ? (votes + 1) : (votes - 1);
                    }else{
                        let votes = this.post.comments[commentKey].likes_count;
                        this.post.comments[commentKey].likes_count = response.data.voteUp ? (votes + 1) : (votes - 1);
                    }
                }).catch(error => {
                    if (error.response) {
                        if (error.response.data.errors.error) {
                            this.$toaster.error(error.response.data.errors.error)
                        } else {
                            this.$toaster.error(error.response.data.errors.error)
                        }
                    }
                });
            },

            saveComment(postId, commentId = null) {
                this.error = false;
                let url = this.$store.state.isLoggedIn ? '/api/auth/post-comment/create' : '/api/post-comment/create';

                this.axios.post(url, {
                    post_id: postId,
                    parent_id: commentId,
                    content: commentId === null ? this.content : this.reply,
                    uid: this.$store.state.isLoggedIn ? null : this.$uoid,
                }).then(response => {
                    this.$toaster.success('The comment was added successfully.');
                    location.reload();
                    this.content = null
                }).catch(error => {
                    if (error.response) {
                        if (error.response.data.errors.error) {
                            this.$toaster.error(error.response.data.errors.error)
                        } else {
                            this.error = true;
                            this.errors = error.response.data.errors
                        }
                    }
                });
            },

            isShow(i) {
                return this.activeKey === i;
            },

            toggleShow(i) {
                this.activeKey = this.isShow(i) ? null : i;
            },
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
        font-size: 13px;
        color: #1b1e21;
    }

    .post-actions span a {
        display: inline;
        color: #585858;
    }

    .comment-card {
        border: none;
        background-color: #f7f7f9;
        border-left: 1px solid #6c757d;
        border-radius: unset;
    }

    .comment-user {
        font-size: 12px;
        color: #6c757d;
    }

    .comment-actions span {
        font-weight: bold;
        font-size: 12px;
        cursor: pointer;
    }

    .comment-actions span:hover {
        font-size: 11px;
        color: #1b1e21;
    }

    .topic-badge {
        width: min-content;
    }
</style>
