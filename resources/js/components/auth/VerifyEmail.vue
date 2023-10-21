<template>
    <div class="container-login p-5">
        <h2 class="text-center">Email Verification</h2>
        <h6 class="mt-5 text-center">Verifica email-ul inainte de autentificare, daca nu ai primit inca email-ul apasa
            >>><b-link @click="sendValidationEmail">aici</b-link><<<</h6>
    </div>
</template>

<script>
import axios from "axios";
import store from "../../stores/store";

export default {
    name: "VerifyEmail",
    methods: {
        sendValidationEmail() {
            console.log('sendValidationEmail')
            axios.get('/api/auth/email/resend').then((response) => {
                this.$toaster.success(response.data.msg)
                this.$router.push({name: 'login'})
            })
        }
    }
}
</script>

<style>
.container-login {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 14px 27px rgba(0,0,0,0.25),
    0 10px 10px rgba(0,0,0,0.22);
    position: relative;
    overflow: hidden;
    width: 768px;
    max-width: 100%;
    min-height: 540px;
    margin:auto;
}
</style>
