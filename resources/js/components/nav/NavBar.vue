<template>
    <nav>
        <!-- Header section -->
        <header class="navbar navbar-expand navbar-dark flex-column flex-md-row bg-dark px-0">
            <div class="container">
                <back-button></back-button>
                <router-link :to="{ name: 'home' }" class="nav-link" style="font-size: 20px"><span style="color: white">Red</span><span style="color: red">clip</span></router-link>
                <ul class="navbar-nav flex-row ml-md-auto d-none d-md-flex">
                    <li class="nav-item" v-if="!this.$store.state.isLoggedIn">
                        <router-link :to="{ name: 'login' }" class="nav-link">Sign</router-link>
                    </li>
                    <li class="nav-item" v-if="!this.$store.state.isLoggedIn">
                        <router-link :to="{ name: 'register' }" class="nav-link">Create Account</router-link>
                    </li>
                    <li class="nav-item mr-3">
                        <search-box></search-box>
                    </li>
                    <li class="nav-item mr-3">
                        <notification></notification>
                    </li>
                    <li class="nav-item dropdown" v-if="this.$store.state.isLoggedIn">
                        <a class="nav-item nav-link dropdown-toggle mr-md-2 p-0 text-white" href="#" id="bd-versions"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <avatar :fullname="this.$store.state.user.name" :size="28" style="position:relative; top:4px"></avatar>
                            <span style="position:relative; top:-4px">{{userFirstName}}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="bd-versions">
                            <a class="dropdown-item" href="#">Detalii</a>
                            <a href="#" class="dropdown-item" @click="logout()">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </header>
        <!-- Header section end -->
    </nav>
</template>

<script>
import BackButton from "./BackButton.vue";
import SearchBox from "./SearchBox.vue";
import Notification from "./Notification.vue";
import Avatar from 'vue-avatar-component'

export default {
    name: "NavBar",
    components: {SearchBox, BackButton, Avatar, Notification},
    methods: {
        logout() {
            this.axios.get('api/auth/logout', {})
                .then(response => {
                    if (response.data.success === true) {
                        delete axios.defaults.headers.common['Authorization']
                        localStorage.removeItem('token')
                        localStorage.removeItem('user')
                        this.$router.push({name: 'home'})
                        location.reload();
                    }
                }).catch(error => {
                if (error.response.data.errors.error) {
                    localStorage.removeItem('token');
                    delete axios.defaults.headers.common['Authorization']
                    this.$toaster.error(error.response.data.errors.error)
                }
            });
        },
    },
    computed: {
        userFirstName() {
            let names = this.$store.state.user.name.split(" ")
            let firstName = names[0]
            return firstName
        }
    }
}
</script>

<style scoped>
.nav-item:after{
    vertical-align: 0.355em
}
</style>
