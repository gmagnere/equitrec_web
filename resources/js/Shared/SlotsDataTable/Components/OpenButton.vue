<template>
    <icon @click="openClicked" v-if="crud.includes('r')"  class="mb-3 cursor-pointer transform hover:scale-110 hover:text-blue-500" name="eye"></icon>
</template>

<script>
import Icon from "@/Shared/Components/Icon"
export default {
    name: "ExpandableButton",
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
        openClicked() {
            this.$emit('openClicked')
        }
    },
}
</script>

<style scoped>

</style>
