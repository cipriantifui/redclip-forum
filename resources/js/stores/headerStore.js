export default {
    state: {
        isShowHeader: false,
        isShowLoader: false,
    },
    mutations: {
        storeIsShowHeader(state, isShow) {
            state.isShowHeader = isShow;
        },
        storeIsShowLoader(state, isShow) {
            state.isShowLoader = isShow;
        }
    },
    getters: {
        isShowHeader(state) {
            return state.isShowHeader;
        },
        isShowLoader(state) {
            return state.isShowLoader;
        }
    }
};
