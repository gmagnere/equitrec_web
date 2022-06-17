<template>
    <td  :colspan="colspan" class="px-5 py-5 border-gray-200 text-sm">
        <slot></slot>
    </td>
</template>

<script>
export default {
    name: "Column",
    props: {
        colspan: {
            type: Number,
            default: 1
        },
    },
}
</script>

<style scoped>

</style>
