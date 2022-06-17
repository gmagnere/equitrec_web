<template>

    <div :class="classBox" class="relative rounded  bg-white lg:p-5 p-2 overflow-auto">
        <div @click="collapse = !collapse" class="hover:bg-gray-100 rounded cursor-pointer flex justify-center">
            <div class="mr-2 flex items-center">
                <icon v-if="!collapse" name="chevron-down"></icon>
                <icon v-else name="chevron-up"></icon>
            </div>

            <h3 class="text-center text-gray-600">
                <slot name="title"></slot>
            </h3>
        </div>

        <div v-if="collapse" class="mt-5">
            <slot name="body"></slot>
        </div>
        <div v-else class="flex justify-center">
<!--            <p>...</p>-->
        </div>

    </div>

</template>

<script>
import Icon from "@/Shared/Components/Icon";
export default {
    name: "DivCollapse",
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
        classBox: String
    },
}
</script>

<style scoped>

</style>
