import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        isLoggedIn: !!localStorage.getItem('token'),
        token: localStorage.getItem('token'),
        user: JSON.parse(localStorage.getItem('user')),
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
        }
    }
})
