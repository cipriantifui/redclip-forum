<template>
    <nav>
        <!-- Header section -->
        <header class="navbar navbar-expand navbar-dark flex-column flex-md-row bg-dark px-0">
            <div class="container">
                <back-button></back-button>
                <router-link :to="{ name: 'home' }" class="nav-link" style="font-size: 20px"><span style="color: white">Red</span><span style="color: red">clip</span></router-link>
                <ul class="navbar-nav flex-row ml-md-auto d-none d-md-flex">
                    <li class="nav-item mr-3">
                        <search-box></search-box>
                    </li>
                    <li class="nav-item dropdown mr-3" v-if="$store.getters.isLoggedIn">
                        <notification></notification>
                    </li>
                    <li class="nav-item dropdown" v-if="$store.getters.isLoggedIn">
                        <profile-drop-down></profile-drop-down>
                    </li>
                    <li class="nav-item" v-if="!$store.getters.isLoggedIn">
                        <router-link :to="{ name: 'login' }" class="nav-link">Sign</router-link>
                    </li>
                    <li class="nav-item" v-if="!$store.getters.isLoggedIn">
                        <router-link :to="{ name: 'register' }" class="nav-link">Create Account</router-link>
                    </li>
                </ul>
            </div>
        </header>
        <nav-bar-header-info></nav-bar-header-info>
    </nav>
</template>

<script>
import BackButton from "./BackButton.vue";
import SearchBox from "./SearchBox.vue";
import Notification from "./Notification.vue";
import ProfileDropDown from "./ProfileDropDown.vue";
import Loader from "../common/Loader.vue";
import NavBarHeaderInfo from "./NavBarHeaderInfo.vue";

export default {
    name: "NavBar",
    components: {NavBarHeaderInfo, Loader, ProfileDropDown, SearchBox, BackButton, Notification},
}
</script>

<style scoped>

</style>
