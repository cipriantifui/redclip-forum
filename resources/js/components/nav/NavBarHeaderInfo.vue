<template>
    <!-- Header section end -->
    <div class="header-info" :style="backgroundColorClass" v-show="$store.getters.isShowHeader">
        <div class="container" v-if="$store.getters.getHeaderPage === 'topic'">
            <loader v-if="$store.getters.isShowLoader"></loader>
            <span v-else>{{headerTitle}}</span>
        </div>
        <div class="container" v-if="$store.getters.getHeaderPage === 'user-posts'">
            <loader v-if="$store.getters.isShowLoader"></loader>
            <div class="row text-lg-left text-center" v-else>
                <div class="col-lg-auto col-sm-12 pl-0">
                    <avatar ref="avatar" @hook:mounted="avatarMounted" :fullname="user.name" :size="100" style="position:relative; top:4px"></avatar>
                </div>
                <div class="col-lg-auto col-sm-12">
                    <p class="user-name">{{user.name}}</p>
                    <p class="user-last-login">
                        <span class="user-card-lastSeen">
                            <i aria-hidden="true" class="fa fa-circle" :class="$store.getters.userStatus.isOnline ? 'online' : 'offline'"></i>
                            {{$store.getters.userStatus.status}}
                        </span>
                        -
                        <i class="fa fa-clock-o" aria-hidden="true"></i> {{ $store.getters.userStatus.lastSeen }} </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Loader from "../common/Loader.vue";
import Avatar from "vue-avatar-component";

export default {
    name: "NavBarHeaderInfo",
    components: {Avatar, Loader},
    data() {
        return {
            backgroundColor: '#888888',
        }
    },
    methods: {
        avatarMounted() {
            this.backgroundColor = this.$refs.avatar.style['background-color']
        },
        convertHex: function (color) {
            color = color.replace('#', '')
            let r = parseInt(color.substring(0, 2), 16)
            let g = parseInt(color.substring(2, 4), 16)
            let b = parseInt(color.substring(4, 6), 16)
            return 'rgba(' + r + ',' + g + ',' + b + ',' + 0.6 + ')'
        }
    },

    computed: {
        headerTitle() {
            return this.$store.getters.getTopic ? this.$store.getters.getTopicTitle : '';
        },
        user() {
            return this.$store.getters.getUserPostsDetails
        },
        backgroundColorClass() {
            let background = this.convertHex(this.backgroundColor)
            return {'background': background}
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
.user-name {
    color: white;
    font-size: 24px;
    text-transform: lowercase;
    margin-top: 10px;
    margin-bottom: 0px;
}
.user-last-login {
    color: white;
    font-size: 18px;
}
.user-card-lastSeen .online {
    color: #94d705
}
.user-card-lastSeen .offline {
    color: #E5E5E5
}
</style>
