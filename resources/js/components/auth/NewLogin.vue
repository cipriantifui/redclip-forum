<template>
    <div class="container-login" :class="panelActiveClass">
        <div class="tabs-menu">
            <div class="tab-btn"
                 :class="{'active': panelActiveClass === 'left-tab-active'}"
                 @click="isLeftTabActive=true">Sign in</div>
            <div class="tab-btn"
                 :class="{'active': panelActiveClass === 'right-tab-active'}"
                 @click="isLeftTabActive=false">Create Account</div>
        </div>
        <div class="form-container-login sing-in-container">
            <h1>Sign in</h1>
            <div class="social-container">
                <a href="#" class="social">
                    <i class="fa fa-facebook"></i>
                    <i class="fa fa-google-plus"></i>
                </a>
            </div>
            <span>or use your account</span>
            <login-form></login-form>
        </div>
        <div class="form-container-login sing-up-container">
            <h1>Create Account</h1>
            <div class="social-container">
                <a href="#" class="social">
                    <i class="fa fa-facebook"></i>
                    <i class="fa fa-google-plus"></i>
                </a>
            </div>
            <span>or use your mail for registration</span>
            <register-form></register-form>
        </div>
        <div class="info-container-login sing-in-placeholder">
            <h1 class="text-white">Welcome Back!</h1>
            <span class="d-block">To keep connected with us please login with your personal info</span>
            <button class="btn-login ghost" @click="isLeftPanelActive=true">Sing In</button>
        </div>
        <div class="info-container-login sing-up-placeholder">
            <h1 class="text-white">Hello, Friend!</h1>
            <span class="d-block">Enter your personal details and start journey with us</span>
            <button class="btn-login ghost" @click="isLeftPanelActive=false">Sing Up</button>
        </div>
    </div>
</template>

<script>
import {useMediaQuery} from "@vueuse/core";
import LoginForm from "./LoginForm.vue";
import RegisterForm from "./RegisterForm.vue";

export default {
    name: "NewLogin",
    components: {RegisterForm, LoginForm},
    data() {
        return {
            name: '',
            email: '',
            password: '',
            confirmPassword: '',
            loginError: false,
            errors: {},
            isLeftPanelActive: true,
            isLeftTabActive: true,
        }
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
    },
    computed: {
        panelActiveClass() {
            const isLargeScreen = useMediaQuery('(min-width: 775px)')
            if(isLargeScreen.value) {
                return this.isLeftPanelActive ? 'left-panel-active' : 'right-panel-active';
            } else {
                return  this.isLeftTabActive ? 'left-tab-active' : 'right-tab-active';
            }
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
.btn-login.ghost {
    background-color: transparent;
    border-color: #fff;
}
.social i {
    background-color: #343a40;
    color: #fff;
    padding: 8px;
    font-size: 18px;
    width: 36px;
    text-align: center;
    text-decoration: none;
    border-radius: 50%;
}
.social i:hover {
    color: #fff;
    text-decoration: none;
    opacity: 0.5;
}
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
.form-container-login {
    position: absolute;
    top: 0;
    height: 100%;
    padding: 30px 0;
    text-align: center;
    transition: all 0.6s ease-in-out;
}
.sing-in-container {
    left: 0;
    width: 50%;
    z-index: 5;
    background-color: #fff
}
.container-login.left-panel-active .sing-in-container {
    opacity: 1;
    transition: opacity 0.5s ease-in-out;
}
.container-login.right-panel-active .sing-in-container {
    transform: translateX(100%);
    z-index: 1;
    opacity:0;
}
.sing-up-container {
    left: 0;
    width: 50%;
    z-index: 1;
    background-color: #fff
}
.container-login.left-panel-active .sing-up-container {
    opacity: 0;
}
.container-login.right-panel-active .sing-up-container {
    transform: translateX(100%);
    opacity: 1;
    z-index: 5;
    transition: opacity 0.5s ease-in-out;
    animation: show 0.6s;
}
.info-container-login {
    position: absolute;
    top: 0;
    height: 100%;
    padding: 20% 25px;
    text-align: center;
    transition: all 0.6s ease-out;
}
.sing-in-placeholder {
    color: #fff;
    left: 0;
    width: 50%;
    background-color: #343a40;
    opacity: 1;
    z-index: 15;
}
.container-login.left-panel-active .sing-in-placeholder {
    transform: translateX(100%);
}
.sing-up-placeholder {
    color: #fff;
    left: 0;
    width: 50%;
    background-color: #343a40;
    opacity: 0;
    z-index: 10;
}
.container-login.left-panel-active .sing-up-placeholder {
    transform: translateX(100%);
    opacity: 1;
    z-index: 15;
    animation: show 0.6s;
}
.container-login .tabs-menu {
    display: none;
    color: #6c757d;
    border-bottom: 1px solid #343a40;
    text-align: center;
    height: 35px;
    font-size: 20px;
}
.container-login .tab-btn {
    color: #6c757d;
    text-align: center;
    height: 35px;
    width: 50%;
    font-size: 20px;
    cursor: pointer
}
.container-login .tab-btn.active {
    color: #fff;
    background-color: #343a40;
}
.container-login.left-tab-active .sing-up-container {
    display: none;
}

.container-login.right-tab-active .sing-in-container {
    display: none;
}

@media(max-width: 775px) {
    .container-login .tabs-menu {
        display: flex;
    }
    .sing-in-container {
        width: 100%;
        opacity: 1;
    }
    .sing-up-container {
        width: 100%;
        opacity: 1;
    }
    .sing-in-placeholder, .sing-up-placeholder {
        display: none;
    }
    .form-container-login {
        transition: none;
        position: relative;
    }
}
</style>
