<template>
    <div>
        <nav-bar></nav-bar>

        <transition name="fade" mode="out-in">
            <div class="container pt-5">
                <router-view></router-view>
            </div>
        </transition>

        <app-discussion></app-discussion>
    </div>
</template>
<script>
    import NavBar from "./components/nav/NavBar.vue";
    import AppDiscussion from "./components/discussion/AppDiscussion.vue";
    import eventHub from "./eventHub";

    export default {
        name: "App.vue",
        components: {AppDiscussion, NavBar},
        data() {
            return {
                eventHub: eventHub
            }
        },
        provide() {
            return {
                eventHub: this.eventHub
            };
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
                        localStorage.removeItem('user')
                        location.reload();
                        this.$router.push({name: 'home'})
                        // you can also redirect to /login if needed !
                    }
                    throw err;
                });
            });
        },
    }
</script>

<style>
.custom-file-label.invalid.is-true,
.custom-select.invalid.is-true,
.form-control.invalid.is-true {
    border: 1px #EB0600 solid;
}
</style>

