export default {
    state: {
        topicSelected: JSON.parse(localStorage.getItem('topicSelected')),
    },
    mutations: {
        storeTopic(state, topic) {
            state.topicSelected = topic
            localStorage.setItem('topicSelected', JSON.stringify(topic))
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
