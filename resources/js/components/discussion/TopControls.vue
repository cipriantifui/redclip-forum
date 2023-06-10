<template>
    <ul class="Composer-controls">
        <li class="item-minimize App-backControl">
            <button class="Button Button--icon Button--link hasIcon"
                    type="button"
                    aria-label="Minimize"
                    itemclassname="App-backControl"
                    v-if="$store.getters.isMinimize === false"
                    @click="$store.commit('toggleMinimize', true)">
                <i aria-hidden="true" class="icon fa fa-minus minimize Button-icon"></i>
                <span class="Button-label"></span>
            </button>
        </li>
        <li class="item-fullScreen">
            <button class="Button Button--icon Button--link hasIcon"
                    type="button"
                    aria-label="Full Screen"
                    v-if="$store.getters.isMinimize === false"
                    @click="$store.commit('toggleExpand')">
                <i aria-hidden="true" class="icon fa fa-expand Button-icon"></i>
                <span class="Button-label"></span>
            </button>
        </li>
        <li class="item-close">
            <button class="Button Button--icon Button--link hasIcon"
                    type="button"
                    aria-label="Close"
                    :style="styleMinimize"
                    @click="handleClose">
                <i aria-hidden="true" class="icon fa fa-times Button-icon"></i>
                <span class="Button-label"></span>
            </button>
        </li>
    </ul>
</template>

<script>
export default {
    name: "TopControls",
    methods: {
        handleClose() {
            this.$store.commit('toggleDiscussion', false)
            this.$store.commit('resetSelectors')
        }
    },
    computed: {
        styleMinimize() {
            return this.$store.getters.isMinimize ? 'top: -5px; position: relative;' : ''
        }
    }
}
</script>

<style scoped>

</style>
