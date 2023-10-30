<template>
    <div class="row">
        <div class="col-xl-2 col-lg-3 col-md-12 mb-lg-0 mb-3">
            <b-link class="btn btn-link text-secondary px-0 mr-2 d-xl-flex d-lg-flex">
                <i class="fa fa-comment mr-2"></i> Posts <span class="ml-2">{{ user.posts_count ?? 0}}</span>
            </b-link>
            <b-link class="btn btn-link text-secondary px-0 mr-2 d-xl-flex d-lg-flex">
                <i class="fa fa-comments mr-2"></i> Comments <span class="ml-2">{{ (user.comments_count +  user.replies_count) ?? 0}}</span>
            </b-link>
            <b-link class="btn btn-link text-secondary px-0 mr-2 d-xl-flex d-lg-flex">
                <i class="fa fa-thumbs-up mr-2"></i> Likes <span class="ml-2">{{ (user.votes_count +  user.comment_votes) ?? 0}}</span>
            </b-link>
        </div>
        <div class="col-xl-10 col-lg-9 col-md-12">
            <div>

            </div>
        </div>
    </div>
</template>

<script>
import UserApi from "../../services/UserApi";

export default {
    name: "UserProfile",
    data() {
        return {
            userId: this.$route.params.user_id,
            section: 'posts',
            page: 1,
            perPage: 5,
            paginate: {},
            meta: {},
            posts: {},
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
        UserApi.getUserPostsDetails(this.userId, this.section)
    },
    methods: {
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
        getLiveStatus() {
            UserApi.getLiveStatus(this.userId)
                .then(response => {
                    this.userStatus = response.data
                    this.$store.commit('storeUserStatus', this.userStatus)
                })
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
</style>
