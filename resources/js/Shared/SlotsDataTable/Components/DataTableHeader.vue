<template>

    <thead>
    <tr @dblclick="displayFilter = !displayFilter">
        <td  v-if="crud.includes('c')">
            <button

                @click="createdClicked"
                class="flex text-gray-600 px-5 py-2 text-md  rounded hover:bg-green-700 hover:text-white">
                <icon name="plus-circle"></icon>
                <span class="text-base ml-2">Ajouter</span>
            </button>
        </td>
        <td class="font-semibold text-gray-800 leading-tight" :colspan="colspanTitle">
            <p class="flex text-xl justify-center">
                <slot name="title"></slot>
            </p>
        </td>
        <td v-if="!!$slots['filters']" :rowspan="displayFilter ? 2 : 1" class="flex justify-end">
            <button
                @click="displayFilter = !displayFilter"
                class="flex text-gray-400 px-5 py-2 text-md  rounded hover:bg-purple-700 hover:text-white">
                <icon name="filter"></icon>
                <icon v-if="!displayFilter" name="chevron-down"></icon>
                <icon v-else name="chevron-up"></icon>
                <span class="text-base ml-2">Filtres</span>
            </button>
        </td>
    </tr>
    <tr v-if="displayFilter" class="bg-white text-gray-600 uppercase text-sm leading-normal">
        <td colspan="99999">
            <div class="flex flex-wrap">
                <slot name="filters"></slot>
            </div>
        </td>
    </tr>
    <tr class="trData text-gray-600 uppercase text-sm leading-normal">
        <slot name="columns-headers"></slot>
        <th></th>
    </tr>
    </thead>

</template>

<script>
import InputBuilder from "@/Shared/DataTable/Components/InputBuilder"
import Icon from "@/Shared/Components/Icon"

export default {
    name: "DataTableHeader",
    data() {
        return {
            displayFilter: false,
        }
    },
    created() {
        console.log(!!this.$slots['filters'])
    },
    components: {
        InputBuilder,
        Icon
    },
    props: {
        colspanTitle: Number,
        crud: {
            type: String,
            default: ""
        }
    },
    methods: {
        createdClicked() {
            this.$emit('createdClicked')
        }
    },
    watch: {

    },
}
</script>

<style scoped>

.trData {
    background-color: #f4f6fa;
    border: 1px solid #e6e7e9;
}

</style>
