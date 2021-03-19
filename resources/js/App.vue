<template>
    <div>
        <nav>
            <!-- Header section -->
            <header class="navbar navbar-expand navbar-dark flex-column flex-md-row bg-dark">
                    <router-link :to="{ name: 'home' }" class="nav-link" style="font-size: 20px"><span style="color: white">Red</span><span style="color: red">clip</span></router-link>
                <ul class="navbar-nav flex-row ml-md-auto d-none d-md-flex">
                    <li class="nav-item">
                        <router-link :to="{ name: 'post-create' }" class="nav-link">Create post</router-link>
                    </li>
                    <li class="nav-item" v-if="!this.$store.state.isLoggedIn">
                        <router-link :to="{ name: 'login' }" class="nav-link">Sign</router-link>
                    </li>
                    <li class="nav-item" v-if="!this.$store.state.isLoggedIn">
                        <router-link :to="{ name: 'register' }" class="nav-link">Create Account</router-link>
                    </li>
                    <li class="nav-item dropdown" v-if="this.$store.state.isLoggedIn">
                        <a class="nav-item nav-link dropdown-toggle mr-md-2" href="#" id="bd-versions"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Contul meu
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="bd-versions">
                            <a class="dropdown-item" href="#">Detalii</a>
                            <a href="#" class="dropdown-item" @click="logout()">Logout</a>
                        </div>
                    </li>
                </ul>
            </header>
            <!-- Header section end -->
        </nav>

        <transition name="fade" mode="out-in">
            <div class="container pt-5">
                <router-view></router-view>
            </div>
        </transition>
    </div>
</template>
<script>
    export default {
        name: "App.vue",
        data() {
            return {

            }
        },
        beforeMount() {
            axios.defaults.headers.common['Content-Type'] = 'application/json;charset=UTF-8'
            const token = localStorage.getItem('token')
            if (token) {
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
            }
        },
        created: function () {

            axios.interceptors.response.use(undefined, function (err) {
                return new Promise(function (resolve, reject) {
                    if (err.response.status === 401 && err.response.config) {
                        // if you ever get an unauthorized, logout the user
                        delete axios.defaults.headers.common['Authorization']
                        localStorage.removeItem('token')
                        this.$router.push({name: 'home'})
                        location.reload();
                        // you can also redirect to /login if needed !
                    }
                    throw err;
                });
            });
        },
        methods: {
            logout() {
                localStorage.removeItem('token');
                location.reload();
                this.axios.get('api/auth/logout', {})
                    .then(response => {
                        if (response.data.success === true) {
                            delete axios.defaults.headers.common['Authorization']
                            localStorage.removeItem('token')
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
        }
    }
</script>

