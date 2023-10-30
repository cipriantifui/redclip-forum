export default {
    state: {
        isLoggedIn: !!localStorage.getItem('token'),
        token: localStorage.getItem('token'),
        user: JSON.parse(localStorage.getItem('user')),
        userStatus: {},
        notLoggedUserId: JSON.parse(localStorage.getItem('uoid')),
    },
    mutations: {
        LoginUser (state, data) {
            state.isLoggedIn = true;
            let token = data.access_token;
            let user = data.user;
            state.token = token;
            state.user = user
            localStorage.setItem('token', token)
            localStorage.setItem('user', JSON.stringify(user))
        },
        LogoutUser (state) {
            state.isLoggedIn = false;
            state.token = localStorage.removeItem('token')
            state.user = JSON.parse(localStorage.removeItem('user'))
        },
        tokenStored (state) {
            state.token = localStorage.getItem('token')
        },
        uidStored (state, uid) {
            state.notLoggedUserId = uid;
        },
        storeUserStatus (state, userStatus) {
            state.userStatus = userStatus;
        }
    },
    getters: {
        isLoggedIn(state) {
            return state.isLoggedIn;
        },
        token(state) {
            return state.token;
        },
        user(state) {
            return state.user;
        },
        userStatus(state) {
            return state.userStatus;
        },
        notLoggedUserId(state) {
            return state.notLoggedUserId;
        }
    }
}
