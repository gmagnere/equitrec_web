<template>
    <th :colspan="colspan" class="cursor-pointer py-3 px-6">
        <div class="flex justify-center">
            <p class="mr-2">
                <slot></slot>
            </p>
        </div>
    </th>
</template>

<script>
export default {
    name: "ColumnHeader",
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
