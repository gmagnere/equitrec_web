<template>

    <label class="inline-flex items-center mt-3">
        <input v-model="checked" type="checkbox" class="form-checkbox rounded h-5 w-5 text-blue-600">
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
        label: String,
        detail: {
          type: Object
        },
        checked: {
            type: Boolean,
            default: false
        }
    },
    watch: {
        checked(newValue) {
            let detail = {
                id: this.detail.id,
                checked: newValue
            }
            this.$emit('checked', detail);
        }
    },
}
</script>

<style scoped>

</style>
