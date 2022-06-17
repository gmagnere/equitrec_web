<template>

    <label class="font-medium text-sm text-gray-700">{{ label }}</label>
    <select-search v-model="modelValue"
                   searchInApiBy="name"
                   labelDisplayed="name"
                   apiRoute="api.agencies"
                   placeholder="Agences"
                   :loadAllOnLoad="true">
    </select-search>

</template>

<script>
import SelectSearch from "@/Shared/Inputs/Select/SelectSearch"
export default {
    name: "AgencySelect",
    data() {
        return {
            value: null
        }
    },
    components: {
        SelectSearch,
    },
    props: {
        modelValue: undefined,
        label :{
            type: String,
            default: ""
        }
    },
    emits: ['update:modelValue'],
    watch: {
        modelValue(newValue, oldValue) {
            this.$emit('update:modelValue', newValue)
        }
    },
}
</script>

<style scoped>

</style>
