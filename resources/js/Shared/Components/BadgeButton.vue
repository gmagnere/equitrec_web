<template>
    <span class="inline-block rounded text-white  px-2 py-1 text-xs font-bold cursor-pointer hover:bg-green-600"
          :class="styleFilled ? 'bg-green-500' : ' text-green-500 hover:text-white'">
        <slot></slot>
    </span>
</template>

<script>
export default {
    name: "BadgeButton",
    props: {
        //Filled ou Outline
        styleFilled: {
            type: Boolean,
            default: true
        },
    },
}
</script>

<style scoped>

</style>
