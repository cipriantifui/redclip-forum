import VueRouter from "vue-router";
import Home from "./components/Home.vue";
import Register from "./components/auth/Register.vue";
import Login from "./components/auth/Login.vue";
import PostCreate from "./components/post/PostCreate.vue";
import PostDetails from "./components/post/PostDetails.vue";
import Topics from "./components/topic/Topics.vue";
import Topic from "./components/topic/Topic.vue";
import UserPosts from "./components/post/UserPosts.vue";

let router = new VueRouter({
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
            path: '/topic/:topic_id',
            name: 'topic',
            component: Topic,
            meta: {
                requiresAuth: false
            }
        },
        {
            path: '/user-posts/:user_id',
            name: 'user-posts',
            component: UserPosts,
            meta: {
                requiresAuth: false
            }
        },
    ]
});

export default router
