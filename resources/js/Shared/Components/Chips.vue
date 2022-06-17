<template>

    <div class="flex justify-center items-center m-1 font-medium py-1 px-2 bg-white rounded-full border" :class="classBtn">
        <div class="text-xs font-normal leading-none max-w-full flex-initial">
            <slot></slot>
        </div>
    </div>

</template>

<script>
export default {
    name: "Chips",
    data() {
        return {
            classBtn: "",
        }
    },
    props: {
        styleName: {
            type: String,
            default: 'blue'
        },
    },
    created() {
        switch (this.styleName) {
            case 'blue':
                this.classBtn = "text-blue-700 bg-blue-100 border-blue-300"
                break;
            default:
        }
    },
}
</script>

<style scoped>

</style>
