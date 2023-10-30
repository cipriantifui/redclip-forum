import VueRouter from "vue-router";
import Home from "./components/Home.vue";
import Register from "./components/auth/Register.vue";
import PostCreate from "./components/post/PostCreate.vue";
import PostDetails from "./components/post/PostDetails.vue";
import Topics from "./components/topic/Topics.vue";
import Topic from "./components/topic/Topic.vue";
import UserPosts from "./components/post/UserProfile.vue";
import NewLogin from "./components/auth/NewLogin.vue";
import PasswordForgot from "./components/auth/PasswordForgot.vue";
import VerifyEmail from "./components/auth/VerifyEmail.vue";
import PasswordReset from "./components/auth/PasswordReset.vue";

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
            component: NewLogin,
            meta: {
                requiresAuth: false
            }
        },

        {
            path: '/password-forgot',
            name: 'password-forgot',
            component: PasswordForgot,
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
            path: '/user-profile/:user_id',
            name: 'user-profile',
            component: UserPosts,
            meta: {
                requiresAuth: false
            }
        },
        {
            path: '/verify-email/:user_id',
            name: 'verify-email',
            component: VerifyEmail,
            meta: {
                requiresAuth: false
            }
        },
        {
            path: '/password-reset',
            name: 'password-reset',
            component: PasswordReset,
            meta: {
                requiresAuth: false
            }
        },
    ]
});

export default router
