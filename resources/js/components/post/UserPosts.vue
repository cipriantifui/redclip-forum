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
    created() {
        this.$store.commit('showHeaderUserPostsPage', true)
        this.getUserPostsDetails()
    },
    methods: {
        getUserPostsDetails() {
            UserApi.getUserPostsDetails(this.userId)
                .then((response) => {
                    if(response.status === 200) {
                        this.user = response.data
                    }
                })
        }
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
