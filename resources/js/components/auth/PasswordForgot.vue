<template>
    <div class="container-forgot-password text-center">
        <h1>Password forgot</h1>
        <span class="d-block my-3">Enter your email address and we will send you a link to reset your password.</span>
        <input type="email"
               class="login-input"
               v-model="email"
               placeholder="Email">
        <button @click="handleRecoverEmail">Recover email</button>
    </div>
</template>

<script>
import store from "../../stores/store";

export default {
    name: "PasswordForgot",
    data() {
        return {
            email: '',
            errors: {},
            hasErrors: false,
        }
    },
    methods: {
        handleRecoverEmail() {
            this.axios.post('api/auth/forget-password', {
                email: this.email,
            }).then(response => {
                // this.$router.push({name: 'home'})
                this.$toaster.success('The password reset link has been successfully sent to your email.')
            }).catch(error => {
                if (error.response.status === 422) {
                    let message = error.response.data.email || error.response.data.errors.email[0]
                    this.$toaster.error(message)
                } else {
                    this.hasErrors = true;
                    this.errors = error.response.data.errors
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
