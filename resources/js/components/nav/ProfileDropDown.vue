<template>
    <div>
        <a class="nav-item nav-link dropdown-toggle mr-md-2 p-0 text-white" href="#" id="bd-versions"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <avatar :fullname="$store.getters.user.name" :size="28" style="position:relative; top:4px"></avatar>
            <span style="position:relative; top:-4px">{{userFirstName}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="bd-versions">
            <a class="dropdown-item" href="#"><i class="fa fa-user mr-2 mb-3" aria-hidden="true"></i> Profile</a>
            <a class="dropdown-item" href="#"><i class="fa fa-cog mr-2" aria-hidden="true"></i> Settings</a>
            <hr class="mt-3">
            <a href="#" class="dropdown-item" @click="logout()"><i class="fa fa-sign-out mr-2" aria-hidden="true"></i> Logout</a>
        </div>
    </div>
</template>

<script>
import Avatar from 'vue-avatar-component'
export default {
    name: "ProfileDropDown",
    components: { Avatar },
    methods: {
        logout() {
            this.axios.get('/api/auth/logout', {})
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
            let names = this.$store.getters.user.name.split(" ")
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
