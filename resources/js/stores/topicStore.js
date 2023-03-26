export default {
    state: {
        topicSelected: {},
    },
    mutations: {
        storeTopic(state, topic) {
            state.topicSelected = topic
        },
    },
    getters: {
        getTopic(state) {
            return state.topicSelected;
        },
        getTopicTitle(state) {
            return state.topicSelected.title;
        },
    }
};
