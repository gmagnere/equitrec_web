<template>

    <label class="inline-flex items-center mt-3">
        <input v-model="modelValue" type="checkbox" @input="$emit('update:modelValue', $event.target.checked)" class="form-checkbox rounded h-5 w-5 text-blue-600">
        <span class="ml-2 text-gray-700">
            {{ label }}
        </span>
    </label>
</template>

<script>
export default {
    name: "Checkbox",
    data() {
    },
    props: {
        modelValue: undefined,
        label: {
            type: String,
            default: ""
        },
    },
}
</script>

<style scoped>

</style>
