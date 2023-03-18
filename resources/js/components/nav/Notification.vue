<template>
    <div>
        <i class="fa fa-bell text-white" aria-hidden="true" style="vertical-align: -0.355em"
            @click="showNotification"></i>
        <div class="card notification-card" v-if="isShowNotificationBox"
             v-click-outside="hideNotification">
            <div class="card-header">
                Notifications
            </div>
            <div class="card-body">
                <div class="text-center">No Notifications</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Notification",
    data() {
        return {
            isShowNotificationBox: false,
            isActiveNotificationBox: false
        }
    },
    methods: {
        showNotification: function () {
            this.isShowNotificationBox = !this.isShowNotificationBox
            setTimeout(() =>{
                this.isActiveNotificationBox = !this.isActiveNotificationBox
            }, 500);
        },
        hideNotification() {
            if(this.isActiveNotificationBox) {
                this.isShowNotificationBox = false
                this.isActiveNotificationBox = false
            }
        }
    }
}
</script>

<style scoped>
.notification-card{
    position: absolute;
    z-index: 100;
    background-color: #fff;
    border:none;
    margin-top: 15px;
    box-shadow: 0px 1px 3px #888888;
    width: 300px;
    right: 70px
}
</style>
