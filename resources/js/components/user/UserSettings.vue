<template>
    <div class="row">
        <div class="col-xl-2 col-lg-3 col-md-12 mb-lg-0 mb-3">
            <b-link class="btn btn-link text-secondary px-0 mr-2 d-xl-flex d-lg-flex" @click="chooseSection('settings')">
                <i class="fa fa-cog mr-2"></i> Settings
            </b-link>
            <b-link class="btn btn-link text-secondary px-0 mr-2 d-xl-flex d-lg-flex" @click="chooseSection('security')">
                <i class="fa fa-shield mr-2"></i> Security
            </b-link>
        </div>
        <div class="col-xl-10 col-lg-9 col-md-12">
            <user-settings-section :user="user" v-if="user" v-show="section === 'settings'"></user-settings-section>
            <user-security-section :user="user" v-if="user" v-show="section === 'security'"></user-security-section>
        </div>
    </div>
</template>

<script>
import UserApi from "../../services/UserApi";
import UserSecuritySection from "./UserSecuritySection.vue";
import UserSettingsSection from "./UserSettingsSection.vue";

export default {
    name: "UserSettings",
    components: {UserSettingsSection, UserSecuritySection},
    data() {
        return {
            userId: this.$route.params.user_id,
            section: 'settings',
            user: null,
        }
    },
    beforeCreate() {
        this.$store.commit('showHeaderUserPostsPage', true)
    },
    created() {
        this.getUserDetails()
        this.getLiveStatus()
    },
    methods: {
        chooseSection(section) {
            this.section = section;
        },
        getLiveStatus() {
            UserApi.getLiveStatus(this.userId)
                .then(response => {
                    this.userStatus = response.data
                    this.$store.commit('storeUserStatus', this.userStatus)
                })
        },
        getUserDetails() {
            this.$store.commit('storeIsShowLoader', true)
            UserApi.getUserDetails(this.userId)
                .then((response) => {
                    if (response.status === 200) {
                        this.user = response.data
                        this.$store.commit('storeUserPostsDetails', this.user)
                    }
                }).catch((errors) => {
            }).finally(() => {
                this.$store.commit('storeIsShowLoader', false)
            })
        },
    }
}
</script>

<style scoped>
.btn-link {
    align-items: baseline!important;
}
</style>
