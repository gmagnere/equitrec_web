<template>

    <label class="font-medium text-sm text-gray-700">{{ label }}</label>
    <select-search v-model="modelValue"
                   searchInApiBy="name"
                   labelDisplayed="name"
                   apiRoute="api.providers"
                   placeholder="Fournisseurs"
    >
        <template #option="{option}">
            <div>
                <p>{{ option.name }}</p>
            </div>
        </template>

        <template #singlelabel="{value}">
            <div class="multiselect-single-label">
<!--                <img class="img-is-user" src="https://randomuser.me/api/portraits/med/women/2.jpg" alt=""> -->
                {{ value.name }}
            </div>
        </template>

    </select-search>

</template>

<script>
import SelectSearch from "@/Shared/Inputs/Select/SelectSearch"
export default {
    name: "UserSelect",
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
        label: {
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
