<template>

    <label class="font-medium text-sm text-gray-700" :class="error ? 'text-red-700' : ''">{{ label }}</label>
    <select-search v-model="modelValue"
                   searchInApiBy="name"
                   labelDisplayed="name"
                   apiRoute="api.users"
                   placeholder="Employés"
                   :loadAllOnLoad="true"
                   :error="error"
    >
        <template #option="{option}">
            <div>
                <p>{{ option.name }}</p>
                <p class="text-xs italic">{{option.options.position}}</p>
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
