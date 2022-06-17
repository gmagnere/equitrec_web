<template>
    <icon @click="updatedClicked" v-if="crud.includes('u')"  class="mb-3 cursor-pointer transform hover:scale-110 hover:text-blue-500" name="pencil"></icon>
</template>

<script>
import Icon from "@/Shared/Components/Icon";
export default {
    name: "UpdateButton",
    components: {
        Icon,
    },
    props: {
        crud: {
            type: String,
            default: ""
        }
    },
    methods: {
        updatedClicked() {
            this.$emit('updatedClicked')
        }
    }
}
</script>

<style scoped>

</style>
