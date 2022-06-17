<template>
    <div class="whitespace-no-wrap self-center flex justify-center rounded py-1 px-2 shadow" :class="bgColor">
        <span>{{ text }}</span>
    </div>
</template>

<script>
export default {
    name: "Tag",
    props: {
        text: String,
        bgColor: {
            type: String,
            default: "bg-gray-100"
        }
    }
}
</script>

<style scoped>

</style>
