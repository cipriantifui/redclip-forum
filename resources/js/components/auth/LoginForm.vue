<template>
    <div>
        <input type="email"
               class="login-input"
               v-model="email"
               placeholder="Email">
        <span class="text text-danger d-block" v-if="loginError && errors.email">
                {{ errors.email[0] }}
            </span>
        <input type="password"
               class="login-input"
               v-model="password"
               placeholder="Password">
        <span class="text text-danger d-block" v-if="loginError && errors.password">
                {{ errors.password[0] }}
            </span>
        <router-link :to="{ name: 'password-forgot' }" class="link-forget-password">Forgot your password?</router-link>
        <button class="btn-login" @click="login">Sing up</button>
        <div class="alert alert-danger d-block" v-if="loginError && errors.message">
            <span>{{ errors.message[0] }}</span>
        </div>
    </div>
</template>

<script>
import store from "../../stores/store";

export default {
    name: "LoginForm",
    data() {
        return {
            email: '',
            password: '',
            loginError: false,
            errors: {},
        }
    },
    methods: {
        login() {
            this.loginError = false;
            this.axios.post('api/auth/login', {
                email: this.email,
                password: this.password
            }).then(response => {
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + response.data.access_token;
                store.commit('LoginUser', response.data);
                this.$router.push({name: 'home'})
            }).catch(error => {
                if (error.response.data.errors.error) {
                    this.$toaster.error(error.response.data.errors.error)
                } else {
                    this.loginError = true;
                    this.errors = error.response.data.errors
                }
            });
        },
    }
}
</script>

<style scoped>
.btn-login {
    border-radius: 20px;
    border: 1px solid #343a40;
    background-color: #343a40;
    color: #fff;
    font-size: 12px;
    font-weight: bold;
    padding: 12px 45px;
    letter-spacing: 1px;
    margin: 8px 0;
    text-transform: uppercase;
    transition: transform 80ms ease-in;
}
.btn-login:active {
    transform: scale(0.95);
}
.btn-login:focus {
    outline: none;
}
.link-forget-password {
    display: block;
    color: #6c757d;
    font-weight: 500;
}
.login-input {
    background-color: #eee;
    border: none;
    border-radius: 0px;
    padding: 12px 15px;
    margin: 8px 0;
    width: 80%;
}
</style>
