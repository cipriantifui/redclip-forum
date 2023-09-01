require('./bootstrap');
window.Vue = require('vue');

import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';
import Toaster from 'v-toaster';
import 'v-toaster/dist/v-toaster.css';
import store from './stores/store';
import VueTimeago from 'vue-timeago'
import App from './App.vue';
import router from "./router";
import { BootstrapVue, BootstrapVueIcons, DropdownPlugin } from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue)
Vue.use(BootstrapVueIcons)
Vue.use(DropdownPlugin)

import { ValidationProvider, ValidationObserver } from 'vee-validate';
import './vee-validate';

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

let uid = localStorage.getItem('uid');
if (typeof uid === 'undefined' || uid === null) {
    localStorage.setItem('uid', Date.now());
    uid = localStorage.getItem('uid');
}
store.commit("uidStored", uid)

new Vue({
    router,
    store,
    el: '#app',
    render: h => h(App)
});
