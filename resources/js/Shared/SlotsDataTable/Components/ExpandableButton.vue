<template>
    <icon @click="$emit('update:modelValue', false)" v-if="modelValue" name="chevron-up" class="cursor-pointer transform hover:scale-110 hover:text-blue-500"></icon>
    <icon @click="$emit('update:modelValue', true)" v-else name="chevron-down" class="cursor-pointer transform hover:scale-110 hover:text-blue-500"></icon>
</template>

<script>
import Icon from "@/Shared/Components/Icon"
export default {
    name: "ExpandableButton",
    props: {
        modelValue: undefined
    },
    components: {
        Icon,
    },
}
</script>

<style scoped>

</style>
