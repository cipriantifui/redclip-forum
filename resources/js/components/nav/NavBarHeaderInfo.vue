<template>
    <!-- Header section end -->
    <div class="header-info" v-show="$store.getters.isShowHeader">
        <div class="container" v-if="$store.getters.getHeaderPage === 'topic'">
            <loader v-if="$store.getters.isShowLoader"></loader>
            <span v-if="$store.getters.isShowLoader === false">{{headerTitle}}</span>
        </div>
        <div class="container" v-if="$store.getters.getHeaderPage === 'user-posts'">

        </div>
    </div>
</template>

<script>
export default {
    name: "NavBarHeaderInfo",
    computed: {
        headerTitle() {
            return this.$store.getters.getTopic ? this.$store.getters.getTopicTitle : '';
        }
    }
}
</script>

<style scoped>
.header-info {
    padding-top: 40px;
    padding-bottom: 30px;
    text-align: center;
    background: #888;
    font-size: 22px;
    color: #fff
}
</style>
