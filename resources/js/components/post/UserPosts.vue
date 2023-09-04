<template>
    <div></div>
</template>

<script>
import UserApi from "../../services/UserApi";

export default {
    name: "UserPosts",
    data() {
        return {
            userId: this.$route.params.user_id,
            page: 1,
            perPage: 5,
            paginate: {},
            meta: {},
            posts: {},
            user: {},
            isLoaded: false
        }
    },
    beforeCreate() {
        this.$store.commit('showHeaderUserPostsPage', true)
    },
    created() {
        this.getUserPostsDetails()
    },
    methods: {
        getUserPostsDetails() {
            this.$store.commit('storeIsShowLoader', true)
            UserApi.getUserPostsDetails(this.userId)
                .then((response) => {
                    if(response.status === 200) {
                        this.user = response.data
                        this.$store.commit('storeUserPostsDetails', this.user)
                    }
                }).catch((errors) => {}).finally(() => {
                    this.$store.commit('storeIsShowLoader', false)
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
</style>
