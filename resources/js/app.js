require('./bootstrap');
window.Vue = require('vue');

import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';
import Toaster from 'v-toaster';
import 'v-toaster/dist/v-toaster.css';
import store from './store';
import VueTimeago from 'vue-timeago'
import App from './App.vue';
import Register from './components/auth/Register.vue';
import Login from './components/auth/Login.vue';
import Home from './components/Home.vue';
import PostDetails from './components/PostDetails.vue';
import PostCreate from './components/PostCreate.vue';
import { BootstrapVue, BootstrapVueIcons } from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue)
Vue.use(BootstrapVueIcons)

import { ValidationProvider, ValidationObserver } from 'vee-validate';
// import { messages } from './vee-validate';

// Register it globally
Vue.component('ValidationProvider', ValidationProvider);
Vue.component('ValidationObserver', ValidationObserver);

Vue.use(VueTimeago, {
    name: 'Timeago', // Component name, `Timeago` by default
    locale: 'ro', // Default locale
})

Vue.use(Toaster, {timeout: 5000});

Vue.use(VueRouter);
Vue.use(VueAxios, axios);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },

        {
            path: '/register',
            name: 'register',
            component: Register,
            meta: {
                requiresAuth: false
            }
        },

        {
            path: '/login',
            name: 'login',
            component: Login,
            meta: {
                requiresAuth: false
            }
        },

        {
            path: '/post/create',
            name: 'post-create',
            component: PostCreate,
            meta: {
                requiresAuth: false
            }
        },

        {
            path: '/post/:post_id',
            name: 'post-details',
            component: PostDetails,
            meta: {
                requiresAuth: false
            }
        },
    ]
});

let uoid = localStorage.getItem('uoid');
if (typeof uoid === 'undefined' || uoid === null) {
    localStorage.setItem('uoid', Date.now());
    uoid = localStorage.getItem('uoid');
}

Vue.prototype.$uoid = uoid

new Vue({
    router,
    store,
    el: '#app',
    render: h => h(App)
});
