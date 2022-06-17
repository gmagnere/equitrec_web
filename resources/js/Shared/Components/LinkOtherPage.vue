<template>
    <div>
        <a :href="href" :class="classes" target="_blank" class="font-semibold text-blue-500 hover:text-blue-800 cursor-pointer">
            <slot></slot>
        </a>
    </div>

</template>

<script>
export default {
    name: "LinkOtherPage",
    props: ['href', 'active', 'classes'],
}
</script>

<style scoped>

</style>
