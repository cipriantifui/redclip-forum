<template>
    <div>
        <!-- Post Type Modal -->
        <b-modal id="discussionTypeModal" title="Choose Type for Your Discussion" hide-footer>
            <div>
                <ul class="TagSelectionModal-list SelectTagList">
                    <li class="pinned colored"
                        :class="{'active': selectedDiscussionType.value === type.value}"
                        v-for="type in discussionsTypes"
                        @click="selectType(type)">
                        <span class="icon TagIcon"></span>
                        <span class="SelectTagListItem-name">{{ type.text }}</span>
                    </li>
                </ul>
            </div>
        </b-modal>

        <!-- Post Tag Modal -->
        <b-modal ref="discussionTagModal" id="discussionTagModal" title="Choose Tags for Your Discussion" hide-footer @hide="handleHideTagModal">
            <div>
                <b-input class="mb-2" placeholder="Search..."
                        v-model="searchText"
                        @input="handleInput">
                </b-input>
                <ul class="TagSelectionModal-list SelectTagList">
                    <li class="pinned colored"
                        :class="{'active': selectedTag.id === tag.id, 'd-none': index > 5}"
                        v-for="(tag, index) in filteredTopics"
                        @click="selectTag(tag)">
                        <span class="icon TagIcon"></span>
                        <span class="SelectTagListItem-name">{{ tag.title }}</span>
                    </li>
                    <li class="pinned colored"
                        v-if="searchText === ''"
                        disabled>
                        <span class="SelectTagListItem-name"> Search for others...</span>
                    </li>
                </ul>
            </div>
        </b-modal>
    </div>
</template>

<script>
import TopicApi from "../../services/TopicApi";

export default {
    name: "AppDiscussionModals",
    data() {
        return {
            discussionsTypes: this.$store.getters.getDiscussionTypeOptions,
            filteredTopics: [],
            topics: [],
            searchText: ''
        }
    },
    created() {
        if(this.$route.name === 'topic') {
            this.$store.commit('selectDiscussionTag', this.$store.getters.getTopic)
            this.searchText = this.$store.getters.getTopic.title
        }

        this.getTopics();
    },
    methods: {
        getTopics() {
            TopicApi.getTopics()
                .then(response => {
                    if(response.status === 200) {
                        this.topics = response.data
                        this.filteredTopics = this.topics
                    }
                }).catch(error => {
            });
        },
        handleInput(e) {
            let searchText = e.toLowerCase();
            if(searchText.length > 0) {
                this.filteredTopics = this.topics.filter((topic) => {
                    return topic.title.toLowerCase().includes(searchText)
                })

            }
        },
        selectTag(tag) {
            this.$store.commit('selectDiscussionTag', tag)
            this.$root.$emit('bv::hide::modal', 'discussionTagModal')
        },
        selectType(type) {
            this.$store.commit('selectDiscussionType', type)
            this.$root.$emit('bv::hide::modal', 'discussionTypeModal')
        },
        handleHideTagModal() {
            this.searchText = ''
        },
    },
    computed: {
        selectedDiscussionType() {
            return this.$store.getters.getSelectedDiscussionType
        },
        selectedTag() {
            return this.$store.getters.getSelectedDiscussionTag
        }
    }
}
</script>

<style scoped>

</style>
