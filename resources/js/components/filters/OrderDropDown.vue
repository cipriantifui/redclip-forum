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
        },
    },
    data() {
        return {
            selectedOption: {}
        }
    },
    created() {
        let selectedOptionIndex = this.options.findIndex(option => option.selected !== undefined && option.selected)
        selectedOptionIndex = selectedOptionIndex > -1 ? selectedOptionIndex : 0;
        this.selectedOption = this.options[selectedOptionIndex]
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
