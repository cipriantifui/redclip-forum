<template>
    <div>
        <!-- Post Type Modal -->
        <div class="modal fade" id="discussionTypeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Choose Type for Your Discussion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="TagSelectionModal-list SelectTagList">
                            <li class="pinned colored"
                                :class="{'active': selectedDiscussionType.value === type.value}"
                                v-for="type in discussionsTypes"
                                @click="$store.commit('selectDiscussionType', type)">
                                <span class="icon TagIcon"></span>
                                <span class="SelectTagListItem-name">{{ type.text }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "AppDiscussionModals",
    data() {
        return {
            discussionsTypes: this.$store.getters.getDiscussionTypeOptions,
        }
    },
    computed: {
        selectedDiscussionType() {
            return this.$store.getters.getSelectedDiscussionType
        }
    }
}
</script>

<style scoped>

</style>
