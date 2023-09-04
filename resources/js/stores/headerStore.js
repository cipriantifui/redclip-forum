export default {
    state: {
        isShowHeader: false,
        isShowLoader: false,
        headerPage: 'topic',
        userPostsDetails: {}
    },
    mutations: {
        storeIsShowHeader(state, isShow) {
            state.isShowHeader = isShow;
        },
        storeIsShowLoader(state, isShow) {
            state.isShowLoader = isShow;
        },
        storeHeaderPage(state, storeHeaderPage) {
            state.headerPage = storeHeaderPage;
        },
        showHeaderTopicPage(state, isShow) {
            state.headerPage = 'topic';
            state.isShowHeader = isShow;
        },
        showHeaderUserPostsPage(state, isShow) {
            state.headerPage = 'user-posts';
            state.isShowHeader = isShow;
        },
        storeUserPostsDetails(state, userPosts) {
            state.userPostsDetails = userPosts;
        }
    },
    getters: {
        isShowHeader(state) {
            return state.isShowHeader;
        },
        isShowLoader(state) {
            return state.isShowLoader;
        },
        getHeaderPage(state) {
            return state.headerPage;
        },
        getUserPostsDetails(state) {
            return state.userPostsDetails;
        },
    },
};
