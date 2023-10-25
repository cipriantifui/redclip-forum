<template>
    <div class="d-flex justify-content-center">
        <div class="spinner-border" :class="customClass" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        customClass: {
            type: String,
            default: 'text-light'
        }
    },
    name: "loader"
}
</script>

<style scoped>

</style>
