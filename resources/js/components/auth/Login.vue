<template>
    <div>
        <!-- sign-in section  -->
        <div class="container pt-5">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="login-form h-100">
                        <div class="lf-title text-center">Sign-in</div>

                        <div class="alert alert-danger" v-if="loginError && errors.message">
                            <span>{{ errors.message[0] }}</span>
                        </div>

                        <div class="row">
                            <div class="input-field col s12 mx-3">
                                <span class="text text-danger" v-if="loginError && errors.email">
                                    {{ errors.email[0] }}
                                </span>
                                <input id="email" type="text" class="validate" v-model="email" placeholder="Your email">
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 mx-3">
                                    <span class="text text-danger" v-if="loginError && errors.password">
                                        {{ errors.password[0] }}
                                    </span>
                                <input id="password" type="password" class="validate" v-model="password"
                                       placeholder="Your password">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mx-auto mb-3 text-center">
                                <button class="site-btn submit mx-auto" type="button" name="action" @click="login()">
                                    Login
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
    import store from '../../stores/store'

    export default {
        name: "Login",
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

</style>
