<template>

    <div
        class="bg-white max-w-screen-sm md:max-w-full overflow-x-auto inline-block w-full shadow-lg border rounded-lg mt-2">
        <table class="text-center w-full leading-normal overflow-auto table-auto">

            <!--            <data-table-header :routeName="routeName" :schemas="schemas" :actions="actions"-->
            <!--                               :crud="crud" @create="create" :title="title"-->
            <!--                               :expandable="expandable"-->
            <!--                               :superFilters="superFilters"-->
            <!--            ></data-table-header>-->

            <data-table-header @createdClicked="createdClicked" :colspanTitle="colspanTitle" :crud="crud">
                <template #title>
                    <slot name="title"></slot>
                </template>
                <template #columns-headers>
                    <slot name="columns-headers"></slot>
                </template>
                <template v-if="!!$slots['filters']"  #filters>
                    <slot name="filters"></slot>
                </template>
            </data-table-header>

            <tbody>

            <slot name="rows"></slot>

            </tbody>
        </table>
    </div>



</template>

<script>

import DataTableHeader from "@/Shared/SlotsDataTable/Components/DataTableHeader";

import DialogModal from "@/Jetstream/DialogModal";
import LoadingButton from "@/Shared/Components/LoadingButton";
import Icon from "@/Shared/Components/Icon";

export default {
    name: "SlotsDataTable",
    data() {
        return {
        }
    },

    components: {
        DataTableHeader,
        DialogModal,
        LoadingButton,
        Icon
    },
    props: {
        crud: {
            type: String,
            default: ""
        },
        showModal: {
            type: Boolean,
            default: false
        },
        colspanTitle: Number
    },
    methods: {
        createdClicked() {
            this.$emit('createdClicked')
        }
    },
    watch: {},
}
</script>

<style scoped>



</style>
