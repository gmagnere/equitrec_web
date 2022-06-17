<template>
    <div class="bg-red-50 border-l-2 border-red-800 p-5 text-red-700" v-if="message">
        {{ message }}
    </div>
</template>

<script>
export default {
    name: "ErrorMessage",
    props: {
        message: {
            type: String,
            default: null
        },
    },
}
</script>

<style scoped>

</style>
