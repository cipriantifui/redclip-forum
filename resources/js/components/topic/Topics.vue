<template>
    <div class="pb-5">
        <div class="row">
            <div class="col-12">
                <left-side-nav :is-show-in-top="true"></left-side-nav>
            </div>
        </div>
    </div>
</template>

<script>
import LeftSideNav from "../nav/LeftSideNav.vue";

export default {
    name: "Topics",
    components: {LeftSideNav}
}
</script>

<style scoped>

</style>
