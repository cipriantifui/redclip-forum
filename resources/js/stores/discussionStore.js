export default {
    state: {
        isShowDiscussion: true,
        isExpanded: false,
        isMinimize: false,
        discussionTypeOptions: [
            { value: 'post', text: 'Post' },
            { value: 'image', text: 'Image' },
            { value: 'video', text: 'Video' }
        ],
        discussionTypeSelected: {}
    },
    mutations: {
        toggleDiscussion(state, isShow) {
            state.isShowDiscussion = isShow
            state.isExpanded = false
            state.isMinimize = false
        },
        toggleExpand(state) {
            state.isExpanded = !state.isExpanded
        },
        toggleMinimize(state, isMinimize) {
            state.isMinimize = isMinimize
        },
        selectDiscussionType(state, type) {
            state.discussionTypeSelected = type
        }
    },
    getters: {
        isShowDiscussion(state) {
            return state.isShowDiscussion
        },
        isExpanded(state) {
            return state.isExpanded
        },
        isMinimize(state) {
            return state.isMinimize
        },
        getDiscussionTypeOptions(state) {
            return state.discussionTypeOptions
        },
        getSelectedDiscussionType(state) {
            return state.discussionTypeSelected
        }
    }
};
