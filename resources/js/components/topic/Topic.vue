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
    beforeMount() {
        this.getTopic();
    },
    methods: {
        getTopic() {
            TopicApi.getTopic(this.topicId)
                .then(response => {
                    this.topic = response.data.data
                    this.posts = response.data.data.posts
                    this.$store.commit('storeTopic', this.topic)
                })
        }
    }
}
</script>

<style scoped>

</style>
