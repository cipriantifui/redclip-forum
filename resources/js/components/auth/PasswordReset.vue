<template>
    <div class="container-forgot-password px-5">
        <h1 class="text-center">Password reset</h1>
        <span class="d-block text-center my-3">Enter your email address and we will send you a link to reset your password.</span>
        <input type="email"
               class="login-input w-100"
               v-model="email"
               placeholder="Email">
        <span class="text text-danger d-block text-left" v-if="hasErrors && errors.email">{{ errors.email[0] }}</span>
        <input type="password"
               class="login-input w-100"
               v-model="oldPassword"
               placeholder="Old password">
        <span class="text text-danger d-block" v-if="hasErrors && errors.oldPassword">{{ errors.oldPassword[0] }}</span>
        <input type="password"
               class="login-input w-100"
               v-model="newPassword"
               placeholder="New password">
        <span class="text text-danger d-block" v-if="hasErrors && errors.newPassword">{{ errors.newPassword[0] }}</span>
        <input type="password"
               class="login-input w-100"
               v-model="confirmPassword"
               placeholder="Confirm password">
        <span class="text text-danger d-block" v-if="hasErrors && errors.confirmPassword">{{ errors.confirmPassword[0] }}</span>
        <span class="text text-danger d-block" v-if="hasErrors && errors.token">{{ errors.token[0] }}</span>
        <div class="row">
            <div class="col text-center">
                <button @click="handleResetPassword">Reset password</button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import store from "../../stores/store";

export default {
    name: "PasswordReset",
    data() {
        return {
            email: '',
            token: '',
            oldPassword: '',
            newPassword: '',
            confirmPassword: '',
            errors: {},
            hasErrors: false,
        }
    },
    mounted() {
        this.email = this.$router.currentRoute.query.email
        this.token = this.$router.currentRoute.query.token
    },
    methods: {
        handleResetPassword() {
            this.hasErrors = false;
            this.errors = '';
            axios.post('/api/password-reset/create', {
                email: this.email,
                token: this.token,
                oldPassword: this.oldPassword,
                newPassword: this.newPassword,
                confirmPassword: this.confirmPassword,
            }).then(response => {
                this.$toaster.success('The password has been changed successfully.')
                delete axios.defaults.headers.common['Authorization']
                localStorage.removeItem('token')
                localStorage.removeItem('user')
                this.$router.push({name: 'login'})
                location.reload();
            }).catch(error => {
                if (error.response.status === 422) {
                    this.hasErrors = true
                    this.errors = error.response.data.errors
                } else {
                    this.$toaster.error(error.response.data.message)
                    this.$router.push({name: 'login'})
                }
            });
        }
    }
}
</script>

<style scoped>
.container-forgot-password {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 14px 27px rgba(0,0,0,0.25),
    0 10px 10px rgba(0,0,0,0.22);
    position: relative;
    overflow: hidden;
    padding: 35px 25px;
    width: 768px;
    max-width: 100%;
    margin:auto;
}
.container-forgot-password input {
    background-color: #eee;
    border: none;
    border-radius: 0px;
    padding: 12px 15px;
    margin: 8px 0;
    width: 80%;
}
.container-forgot-password button {
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
</style>
