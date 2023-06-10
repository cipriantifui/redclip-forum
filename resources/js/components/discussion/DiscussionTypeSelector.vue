<template>
    <div class="Composer-type-selector mt-2" style="display: contents">
        <div class="d-flex">
            <a class="DiscussionComposer-changeTags mr-3" @click="$root.$emit('bv::show::modal', 'discussionTypeModal')">
                <span class="TagLabel">Type: {{$store.getters.getSelectedDiscussionType.text}}</span>
            </a>
            <a class="DiscussionComposer-changeTags" @click="handleChooseTag">
                <span class="TagLabel" :class="{'untagged': selectedTopic === null, 'is-invalid': hasError}">{{topicText}}</span>
            </a>
        </div>
    </div>
</template>

<script>
export default {
    inject: ["eventHub"],
    name: "DiscussionTypeSelector",
    data() {
        return {
            hasError: false
        }
    },
    beforeMount() {
        this.$store.commit('selectDiscussionType', this.$store.getters.getDiscussionTypeOptions[0])
        this.eventHub.$on('tagSelectEvent', (hasError) => {
            this.hasError = hasError
        })
    },
    methods: {
        handleChooseTag() {
            this.hasError = false
            this.$root.$emit('bv::show::modal', 'discussionTagModal')
        }
    },
    computed: {
        selectedTopic() {
            return this.$store.getters.getSelectedDiscussionTag ? this.$store.getters.getSelectedDiscussionTag : null
        },
        topicText() {
            return this.selectedTopic !== null ? 'Topic:' + this.selectedTopic.title : 'Choose Topic'
        }
    }
}
</script>

<style scoped>
.TagLabel.is-invalid {
    border: 1px #EB0600 dotted;
    color: #dc3545
}
</style>
