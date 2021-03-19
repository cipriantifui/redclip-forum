<template>
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="login-form">
                    <div class="lf-title text-center">Create account</div>

                    <div class="alert alert-danger" v-if="error && errors.message">
                        <span>{{ errors.message[0] }}</span>
                    </div>

                    <div class="row">
                        <div class="input-field col s12 mx-3">
                            <span class="text text-danger" v-if="error && errors.name">
                                {{ errors.name[0] }}
                            </span>
                            <input id="name" type="text" class="validate" v-model="name" placeholder="Your name">
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12 mx-3">
                            <span class="text text-danger" v-if="error && errors.email">{{ errors.email[0] }}</span>
                            <input id="email" type="text" class="validate" v-model="email" placeholder="Your email">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 mx-3">
                            <span class="text text-danger"
                                  v-if="error && errors.password">{{ errors.password[0] }}</span>
                            <input id="password" type="password" class="validate" v-model="password"
                                   placeholder="Your password">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 mx-3">
                            <span class="text text-danger" v-if="error && errors.confirmPassword">{{ errors.confirmPassword[0] }}</span>
                            <input id="confirm_password" type="password" class="validate" v-model="confirmPassword"
                                   placeholder="Confirm password">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mx-auto mb-3 text-center">
                            <button class="site-btn submit mx-auto" type="button" name="action"
                                    @click.prevent="register()">Register
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: '',
                email: '',
                password: '',
                confirmPassword: '',
                error: false,
                errors: {},
                success: false
            };
        },
        methods: {
            register() {
                this.axios.post('api/auth/register', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    confirmPassword: this.confirmPassword
                }).then(response => {
                    this.$router.push({name: 'login'})
                    this.$toaster.success(response.data.message)
                }).catch(error => {
                    if (error.response.data.errors.error) {
                        this.$toaster.error(error.response.data.errors.error)
                    } else {
                        this.error = true;
                        this.errors = error.response.data.errors
                    }
                });
            }
        }
    }
</script>
