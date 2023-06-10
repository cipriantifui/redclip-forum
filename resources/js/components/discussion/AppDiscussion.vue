<template>
    <div>
        <div class="app-discussion" v-if="isShowDiscussion">
            <div class="container">
                <div id="composer">
                    <div class="Composer visible" :class="viewModeClass">
                        <div class="Composer-handle" style="cursor: row-resize;" v-if="$store.getters.isMinimize === false"></div>
                        <top-controls></top-controls>
                        <div class="Composer-content">
                            <div class="minimized-placeholder"
                                v-if="$store.getters.isMinimize"
                                @click="$store.commit('toggleMinimize', false)">Write a post...</div>
                            <discussion-type-selector v-if="$store.getters.isMinimize === false"></discussion-type-selector>
                            <div class="Composer-body mt-3" v-if="$store.getters.isMinimize === false && selectedDiscussionType">
                                <post-discussion-form v-if="selectedDiscussionType.value == 'post'"></post-discussion-form>
                                <image-discussion-form v-if="selectedDiscussionType.value == 'image'"></image-discussion-form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <app-discussion-modals></app-discussion-modals>
    </div>
</template>

<script>
import TopControls from "./TopControls.vue";
import DiscussionTypeSelector from "./DiscussionTypeSelector.vue";
import AppDiscussionModals from "./DiscussionModals.vue";
import PostDiscussionForm from "./PostDiscussionForm.vue";
import ImageDiscussionForm from "./ImageDiscussionForm.vue";

export default {
    name: "AppDiscussion",
    components: {ImageDiscussionForm, PostDiscussionForm, AppDiscussionModals, DiscussionTypeSelector, TopControls},
    data() {
        return {
            hasError: false,
            errors: {},
            title: '',
            content: '',
        }
    },
    methods: {
    },
    computed: {
        viewModeClass() {
            let viewMode = 'normal active';
            if(this.$store.getters.isExpanded) {
                viewMode = 'fullScreen';
            }
            if(this.$store.getters.isMinimize) {
                viewMode = 'minimized';
            }
            return viewMode;
        },
        isShowDiscussion() {
            return this.$store.getters.isShowDiscussion
        },
        selectedDiscussionType() {
            return this.$store.getters.getSelectedDiscussionType
        },
    }
}
</script>

<style scoped>

</style>
