<template>
    <div class="card post-card px-3 py-1 mb-2">
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
                height="100%"
                autoplay="false"
                frameborder="0">
            </iframe>
        </p>
        <p class="post-actions">
            <span @click="savePostVote(post.id)"><i class="fa fa-thumbs-up"></i> {{post.votes_count}} UpVotes </span>
            <span><router-link :to="{ name: 'post-details', params: {post_id: post.id} }"
                               class="nav-link"><i class="fa fa-comment"></i> {{post.comments_count}} Comments</router-link></span>
        </p>
    </div>
</template>

<script>
import VoteApi from "../../services/VoteApi";

export default {
    name: "PostCard",
    props: {
        post: {type: Object, require: true}
    },
    methods: {
        savePostVote(postId) {
            VoteApi.saveVote(postId)
                .then(response => {
                    let votes = this.post.votes_count;
                    this.post.votes_count = response.data.voteUp ? (votes + 1) : (votes - 1);
                }).catch(error => {
                    if (error.response) {
                        if (error.response.data.errors.error) {
                            this.$toaster.error(error.response.data.errors.error)
                        } else {
                            this.$toaster.error(error.response.data.errors.error)
                        }
                    }
                })
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

    .topic-badge {
        width: min-content;
    }
</style>
