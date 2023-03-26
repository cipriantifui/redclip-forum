<template>

</template>

<script>
import TopicApi from "../../services/TopicApi";

export default {
    name: "Topic",
    data() {
        return {
            topicId: this.$route.params.topic_id,
            topic: {},
            posts: []
        }
    },
    mounted() {
        TopicApi.getTopic(this.topicId)
            .then(response => {
                this.topic = response.data.data
                this.posts = response.data.data.posts
            })
    }
}
</script>

<style scoped>

</style>
