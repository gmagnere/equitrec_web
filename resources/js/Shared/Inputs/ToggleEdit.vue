<template>

    <div>

        <div v-if="!isEditMode">
            <slot name="readMode"></slot>
        </div>
        <div v-else>
            <slot name="editMode"></slot>
        </div>


    </div>


</template>

<script>
export default {
    name: "ToggleEdit",
    props: {
        isEditMode: {
            type: Boolean,
            default: false
        },
    },
}
</script>

<style scoped>

</style>
