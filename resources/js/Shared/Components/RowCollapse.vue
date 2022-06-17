<template>
    <tr class="bg-gray-200">
        <td :colspan="colspanTitle">
            <div @click="collapse = !collapse" class="hover:bg-gray-100 rounded cursor-pointer flex justify-center">
                <div class="mr-2 flex items-center">
                    <icon v-if="!collapse" name="chevron-down"></icon>
                    <icon v-else name="chevron-up"></icon>
                </div>
                <h3 class="text-center text-gray-600">
                    <slot name="title"></slot>
                </h3>
            </div>
        </td>
    </tr>
    <template v-if="collapse">
        <slot name="body"></slot>
    </template>

</template>

<script>
import Icon from "@/Shared/Components/Icon";

export default {
    name: "RowCollapse",
    data() {
        return {
            collapse: this.isCollapse
        }
    },
    components: {
        Icon,
    },
    props: {
        isCollapse: {
            type: Boolean,
            default: false
        },
        classBox: String,
        colspanTitle: {
            type: Number,
            default: 1
        }
    },
}
</script>

<style scoped>

</style>
