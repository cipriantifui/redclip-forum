<template>
    <div>
        <input type="text"
               class="login-input"
               v-model="name"
               placeholder="Name">
        <span class="text text-danger d-block" v-if="error && errors.name">{{ errors.name[0] }}</span>

        <input type="email"
               class="login-input"
               v-model="email"
               autocomplete="off"
               placeholder="Email">
        <span class="text text-danger d-block" v-if="error && errors.email">{{ errors.email[0] }}</span>

        <input type="password"
               class="login-input"
               v-model="password"
               autocomplete="off"
               placeholder="Password">
        <span class="text text-danger d-block" v-if="error && errors.password">{{ errors.password[0] }}</span>

        <input type="password"
               class="login-input"
               v-model="confirmPassword"
               placeholder="Confirmation password">
        <span class="text text-danger d-block" v-if="error && errors.confirmPassword">{{ errors.confirmPassword[0] }}</span>

        <button class="btn-login" @click="register">Sing up</button>

        <div class="alert alert-danger" v-if="error && errors.message">
            <span>{{ errors.message[0] }}</span>
        </div>
    </div>
</template>

<script>
export default {
    name: "RegisterForm",
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
