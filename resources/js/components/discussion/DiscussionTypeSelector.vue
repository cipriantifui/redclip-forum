<template>
    <div class="Composer-type-selector mt-2">
        <div class="d-flex">
            <a class="DiscussionComposer-changeTags mr-3" data-toggle="modal" data-target="#discussionTypeModal">
                <span class="TagLabel">{{$store.getters.getSelectedDiscussionType.text}}</span>
            </a>
            <a class="DiscussionComposer-changeTags"><span class="TagLabel untagged">Choose Topic</span></a>
        </div>
    </div>
</template>

<script>
export default {
    name: "DiscussionTypeSelector",
    data() {
        return {
            selectedType: 'post',
            selectedTopic: null,
        }
    },
    beforeMount() {
        this.$store.commit('selectDiscussionType', this.$store.getters.getDiscussionTypeOptions[0])
    }
}
</script>

<style scoped>

</style>
