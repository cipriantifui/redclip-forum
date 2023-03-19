<template>
    <div>
        <a class="nav-item nav-link dropdown-toggle p-0 text-white" href="#" id="bd-versions"
           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-bell text-white" aria-hidden="true" style="vertical-align: -0.355em"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right notification-card" aria-labelledby="bd-versions">
            <div class="card-header"><strong>Notifications</strong></div>
            <div class="card-body">
                <div class="text-center">No Notifications</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Notification",
}
</script>

<style scoped>
.notification-card {
    width: 300px;
}
.dropdown-toggle::after{
    display: none;
}
</style>
