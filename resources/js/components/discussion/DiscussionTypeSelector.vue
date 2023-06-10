<template>
    <div class="Composer-type-selector mt-2">
        <div class="d-flex">
            <a class="DiscussionComposer-changeTags mr-3" @click="$root.$emit('bv::show::modal', 'discussionTypeModal')">
                <span class="TagLabel">Type: {{$store.getters.getSelectedDiscussionType.text}}</span>
            </a>
            <a class="DiscussionComposer-changeTags" @click="$root.$emit('bv::show::modal', 'discussionTagModal')">
                <span class="TagLabel" :class="{'untagged': selectedTopic === null}">{{topicText}}</span>
            </a>
        </div>
    </div>
</template>

<script>
export default {
    name: "DiscussionTypeSelector",
    beforeMount() {
        this.$store.commit('selectDiscussionType', this.$store.getters.getDiscussionTypeOptions[0])
    },
    computed: {
        selectedTopic() {
            return Object.keys(this.$store.getters.getSelectedDiscussionTag).length > 0 ? this.$store.getters.getSelectedDiscussionTag : null
        },
        topicText() {
            return this.selectedTopic !== null ? 'Topic:' + this.selectedTopic.title : 'Choose Topic'
        }
    }
}
</script>

<style scoped>

</style>
