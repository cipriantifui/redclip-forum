<template>
    <div class="row">
        <div class="col-xl-2 col-lg-3 col-md-12 mb-lg-0 mb-3">
            <b-link class="btn btn-link text-secondary px-0 mr-2 d-xl-flex d-lg-flex" @click="chooseSection('posts')">
                <i class="fa fa-comment mr-2"></i> Posts <span class="ml-2">{{ user.posts_count ?? 0}}</span>
            </b-link>
            <b-link class="btn btn-link text-secondary px-0 mr-2 d-xl-flex d-lg-flex" @click="chooseSection('comments')">
                <i class="fa fa-comments mr-2"></i> Comments <span class="ml-2">{{ commentsCounter }}</span>
            </b-link>
            <b-link class="btn btn-link text-secondary px-0 mr-2 d-xl-flex d-lg-flex" @click="chooseSection('likes')">
                <i class="fa fa-thumbs-up mr-2"></i> Likes <span class="ml-2">{{ user.votes_count ?? 0}}</span>
            </b-link>
        </div>
        <div class="col-xl-10 col-lg-9 col-md-12">
            <div>
                <user-post-detail-card v-for="detail in postDetails"
                                  v-if="section === 'posts'"
                                  :key="detail.id"
                                  :detail="detail"
                                  :section="section"
                                  :user="user"></user-post-detail-card>
                <user-comment-detail-card v-for="detail in commentDetails"
                                  v-if="section === 'comments'"
                                  :key="detail.id"
                                  :detail="detail"
                                  :section="section"
                                  :user="user"></user-comment-detail-card>
                <user-like-detail-card v-for="detail in likeDetails"
                                  v-if="section === 'likes'"
                                  :key="detail.id"
                                  :detail="detail"
                                  :section="section"
                                  :user="user"></user-like-detail-card>
            </div>
            <div class="empty-details-container" v-show="showEmptyDetailsText">
                {{ emptyDetailsText }}
            </div>
            <div class="col text-center mt-3" v-show="showViewMoreButton">
                <button type="button" class="btn btn-secondary" @click="handleViewMore">View-more</button>
            </div>
        </div>
    </div>
</template>

<script>
import UserApi from "../../services/UserApi";
import UserPostDetailCard from "./UserPostDetailCard.vue";
import UserCommentDetailCard from "./UserCommentDetailCard.vue";
import UserLikeDetailCard from "./UserLikeDetailCard.vue";

export default {
    name: "UserProfile",
    components: {UserLikeDetailCard, UserCommentDetailCard, UserPostDetailCard},
    data() {
        return {
            userId: this.$route.params.user_id,
            section: 'posts',
            page: 1,
            perPage: 5,
            paginate: {},
            meta: {},
            postDetails: [],
            commentDetails: [],
            likeDetails: [],
            user: {},
            userStatus: {},
            isLoaded: false
        }
    },
    beforeCreate() {
        this.$store.commit('showHeaderUserPostsPage', true)
    },
    created() {
        if(this.$route.params.section !== undefined) {
            this.section = this.$route.params.section
        }
        this.getUserDetails()
        this.getLiveStatus()
        this.getUserPostsDetails(this.section)
    },
    methods: {
        handleViewMore() {
            console.log(this.section)
            this.getUserPostsDetails()
        },
        getUserDetails() {
            this.$store.commit('storeIsShowLoader', true)
            UserApi.getUserDetails(this.userId)
                .then((response) => {
                    if(response.status === 200) {
                        this.user = response.data
                        this.$store.commit('storeUserPostsDetails', this.user)
                    }
                }).catch((errors) => {}).finally(() => {
                    this.$store.commit('storeIsShowLoader', false)
            })
        },
        chooseSection(section) {
            this.getUserPostsDetails(section)
        },
        getUserPostsDetails(section) {
            this.section = section
            UserApi.getUserPostsDetails(this.userId, section)
                .then(response => {
                    if(response.status === 200) {
                        if(section === 'posts') {
                            this.postDetails = response.data.data;
                        }
                        if(section === 'comments') {
                            this.commentDetails = response.data.data;
                        }
                        if(section === 'likes') {
                            let responseMap = {};
                            if(response.data.data.length > 0) {
                                responseMap = response.data.data.map((data) => {
                                    return data.votable;
                                })
                            }
                            this.likeDetails = responseMap;
                        }
                    }
                })
        },
        getLiveStatus() {
            UserApi.getLiveStatus(this.userId)
                .then(response => {
                    this.userStatus = response.data
                    this.$store.commit('storeUserStatus', this.userStatus)
                })
        }
    },
    computed: {
        commentsCounter() {
            return (this.user.comments_count ?? 0) + (this.user.replies_count ?? 0);
        },
        emptyDetailsText() {
            return `It looks like there are no ${this.section} here.`
        },
        showEmptyDetailsText() {
            let postsCounter = this.user.posts_count;
            let votesCounter = this.user.votes_count;
            return this.section === 'posts' && postsCounter === 0 ||
                this.section === 'comments' && this.commentsCounter === 0 ||
                this.section === 'likes' && votesCounter === 0
        },
        showViewMoreButton() {
            let postsCounter = this.user.posts_count;
            let votesCounter = this.user.votes_count;
            return this.section === 'posts' && postsCounter > 3 ||
                this.section === 'comments' && this.commentsCounter > 3 ||
                this.section === 'likes' && votesCounter > 3
        }
    },
    destroyed() {
        this.$store.commit('showHeaderUserPostsPage', false)
    }
}
</script>

<style scoped>
.header-info {
    padding-top: 40px;
    padding-bottom: 30px;
    text-align: center;
    background: #888;
    font-size: 22px;
    color: #fff
}
.btn-link {
    align-items: baseline!important;
}
.empty-details-container {
    color: #808080;
    font-family: system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",Ubuntu,Cantarell,Oxygen,Roboto,Helvetica,Arial,sans-serif;
    font-size: 20px;
    line-height: 1.5;
    text-align: center;
    margin-top: 45px;
}
</style>
