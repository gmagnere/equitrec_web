<template>

    <label class="font-medium text-sm text-gray-700" :class="error ? 'text-red-700' : ''">{{ label }}</label>
    <select-search v-model="modelValue"
                   searchInApiBy="label"
                   labelDisplayed="label"
                   apiRoute="api.sites.types"
                   placeholder="Prestations"
                   :loadAllOnLoad="true"
                   :error="error"
    >
    </select-search>

</template>

<script>
import SelectSearch from "@/Shared/Inputs/Select/SelectSearch"
export default {
    name: "SiteTypeSelect",
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
        },
        error: String,
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
