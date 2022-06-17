<template>

    <button :class="classBtn" :disabled="loading" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring disabled:opacity-25 transition">
        <div v-if="loading" class="btn-spinner mr-2" />
        <icon :name="icon"></icon>
        <span v-if="text" class="ml-2">{{text}}</span>
    </button>

</template>

<script>
import Icon from "@/Shared/Components/Icon";
export default {
    name: "LoadingButton",
    data() {
        return {
            classBtn: "",
        }
    },
    created() {
        switch (this.styles) {
            case 'create':
                this.classBtn = "bg-green-700 hover:bg-green-600 active:bg-green-800 focus:border-green-800 focus:ring-green-200"
                break;
            case 'update':
                this.classBtn = "bg-blue-700 hover:bg-blue-600 active:bg-blue-800 focus:border-blue-800 focus:ring-blue-200"
                break;
            case 'relation':
                this.classBtn = "bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-800 focus:border-indigo-800 shadow focus:ring-indigo-200"
                break;
            case 'danger':
                this.classBtn = "bg-red-600 hover:bg-red-500 active:bg-red-800 focus:border-red-800 shadow focus:ring-red-200"
                break;
            case 'info':
                this.classBtn = "bg-blue-600 hover:bg-blue-500 active:bg-blue-800 focus:border-blue-800 shadow focus:ring-blue-200"
                break;
            case 'secondary':
                this.classBtn = "bg-gray-600 hover:bg-gray-500 active:bg-gray-800 focus:border-gray-800 shadow focus:ring-gray-200"
                break;
            case 'warning':
                this.classBtn = "bg-yellow-600 hover:bg-yellow-500 active:bg-yellow-800 focus:border-yellow-800 shadow focus:ring-yellow-200"
                break;
            default:
        }
    },
    components: {
        Icon
    },
    props: {
        loading: Boolean,
        icon: String,
        styles: String,
        text: String
    },

}
</script>

<style scoped>

</style>
