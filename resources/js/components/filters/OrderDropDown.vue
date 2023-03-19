<template>
    <b-dropdown id="dropdown-1"
                :text="selectedOption.name"
                split
                split-variant="outline-secondary"
                variant="secondary">
        <b-dropdown-item v-for="(option, index) in options" :key="index"
            @click="choose(option)">{{option.name}}</b-dropdown-item>
    </b-dropdown>
</template>

<script>
export default {
    name: "OrderDropDown",
    props: {
        options: {
            type: Array,
            require: true
        }
    },
    data() {
        return {
            selectedOption: {}
        }
    },
    created() {
        this.selectedOption = this.options[0]
        this.$emit('selectedOption', {option: this.selectedOption, isChoose: false})
    },
    methods: {
        choose(option) {
            this.selectedOption = option
            this.$emit('selectedOption', {option: option, isChoose: true})
        }
    }
}
</script>

<style scoped>

</style>
