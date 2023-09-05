<template>
    <a class="nav-back" @click="back" v-if="isVisible">
        <i class="fa fa-lg fa-chevron-circle-left text-white" aria-hidden="true"></i>
    </a>
</template>

<script>
export default {
    name: "BackButton",
    data() {
        return {
            pages: ['home', 'login', 'register', 'new-login'],
            isVisible: false
        }
    },
    created() {
        this.isVisible = this.pages.includes(this.$router.currentRoute.name) === false
    },
    watch:{
        $route (to, from){
            this.isVisible = this.pages.includes(to.name) === false
        }
    },
    methods: {
        back() {
            this.$router.go(-1)
        },
    },
}
</script>

<style scoped>
.nav-back {
    position: absolute;
    top: 20px;
    left: 25px;
}
</style>
