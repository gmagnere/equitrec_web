<template>
    <icon class="cursor-pointer transform" :name="iconName" :class="classes" :h="h" :w="w"></icon>
</template>

<script>
import Icon from "@/Shared/Components/Icon"
export default {
    name: "IconButton",
    components: {
        Icon,
    },
    props: {
        iconName: String,
        classes: {
            type: String,
            default: "hover:scale-110 hover:text-blue-500 mb-3"
        },
        h: {
            type: String,
            default: "6"
        },
        w: {
            type: String,
            default: "6"
        },
    },
    methods: {
        // click() {
        //     this.$emit('click')
        // }
    },
}
</script>

<style scoped>

</style>
