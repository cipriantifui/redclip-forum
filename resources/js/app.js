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
import PostDetails from './components/post/PostDetails.vue';
import PostCreate from './components/post/PostCreate.vue';
import Topics from './components/topic/Topics.vue';
import Topic from './components/topic/Topic.vue';
import { BootstrapVue, BootstrapVueIcons, DropdownPlugin } from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue)
Vue.use(BootstrapVueIcons)
Vue.use(DropdownPlugin)

import { ValidationProvider, ValidationObserver } from 'vee-validate';
import './vee-validate';

Vue.directive('click-outside', {
    bind: function (el, binding, vnode) {
        el.clickOutsideEvent = function (event) {
            // here I check that click was outside the el and his children
            if (!(el == event.target || el.contains(event.target))) {
                // and if it did, call method provided in attribute value
                vnode.context[binding.expression](event);
            }
        };
        document.body.addEventListener('click', el.clickOutsideEvent)
    },
    unbind: function (el) {
        document.body.removeEventListener('click', el.clickOutsideEvent)
    },
});

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
        {
            path: '/topics',
            name: 'topics',
            component: Topics,
            meta: {
                requiresAuth: false
            }
        },
        {
            path: '/topic',
            name: 'topic',
            component: Topic,
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
