<template>
    <tr class="border-b border-gray-200 color-blue-custom">

        <!-- ****** ACTIONS ******* -->
        <td v-if="!!$slots['actionsStart']" class="px-5 py-5 border-b border-gray-200 text-sm ">
            <slot name="actionsStart"></slot>
        </td>

        <slot></slot>

        <!-- ****** ACTIONS ******* -->
        <td v-if="!!$slots['actionsStart']" class="px-5 py-5 border-b border-gray-200 text-sm ">
            <slot name="actionsEnd"></slot>
        </td>
    </tr>

    <slot name="expandable"></slot>

</template>

<script>
import Icon from "@/Shared/Components/Icon";
export default {
    name: "Row",
    data() {
        return {
            withExpandable: !!this.$slots['expandable']
        }
    },
    components: {
        Icon
    },


}
</script>

<style scoped>

</style>
