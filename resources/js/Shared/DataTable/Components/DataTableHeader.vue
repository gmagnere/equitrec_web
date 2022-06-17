<template>

    <thead>
    <tr>
        <td>
            <button
                v-if="crud.includes('c')"
                @click="create"
                class="flex text-gray-600 px-5 py-2 text-md  rounded hover:bg-green-700 hover:text-white">
                <icon name="plus-circle"></icon>
                <span class="text-base ml-2">Ajouter</span>
            </button>
        </td>
        <td class="font-semibold text-gray-800 leading-tight" @dblclick="displayFilter = !displayFilter" :colspan="schemas.length - (crud.includes('u') || crud.includes('d') || actions ? 1 : 2) ">
            <p class="flex text-xl justify-center">
                {{ title }}
            </p>
        </td>
        <td v-if="!settings.hideFilter" :rowspan="displayFilter ? 2 : 1" class="flex justify-end">
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
    <tr v-if="displayFilter && superFilters">
<!--        <td v-for="filtre in superFilters" :colspan="filtre.colspan ? filtre.colspan : 1">-->
<!--            <input-builder :schema="filtre" :form="params" :isHeader="true"></input-builder>-->
<!--        </td>-->
        <td colspan="9999" >
            <div class="flex flex-wrap">
                <template v-for="filtre in superFilters">
<!--                    {{filtre}}-->
                    <input-builder :schema="filtre" :form="params" :isHeader="true"></input-builder>
                </template>
            </div>
        </td>

<!--        <td>-->
<!--            <input-builder v-for="filtre in superFilters" :schema="filtre" :form="params" :isHeader="true"></input-builder>-->
<!--        </td>-->
    </tr>
    <tr v-if="displayFilter" class="bg-white text-gray-600 uppercase text-sm leading-normal">
<!--        <td v-for="schema in schemas">-->
<!--            <input-builder v-if="schema.type !== 'files' && !schema.notFilterable" :schema="schema" :form="params" :isHeader="true"></input-builder>-->
<!--        </td>-->
        <td colspan="9999" >
            <div class="flex flex-wrap">
                <template v-for="schema in schemas">
                    <input-builder v-if="schema.type !== 'files' && !schema.notFilterable" :schema="schema" :form="params" :isHeader="true"></input-builder>
                </template>
            </div>
        </td>
    </tr>
    <tr class="trData text-gray-600 uppercase text-sm leading-normal">
        <th @click="!(schema.relations || schema.type == 'files') ? sort(schema.form) : '' " v-for="schema in schemas" class="cursor-pointer py-3 px-6">
            <div class="flex justify-center">
                <p class="mr-2">{{ schema.label }}</p>
                <icon v-if="params.field === schema.form && params.direction === 'asc'" h=4 w=4 name="sort-ascending" class="self-center"></icon>
                <icon v-if="params.field === schema.form && params.direction === 'desc'" h=4 w=4 name="sort-descending" class="self-center"></icon>
            </div>
        </th>
        <th v-if="crud.includes('u') || crud.includes('d') || actions" class="py-3 px-6" :colspan="schemas.length > 1 ? 1 : 2">Actions</th>
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
            params: {},
        }
    },

    components: {
        InputBuilder,
        Icon
    },
    props: {
        schemas: Array,
        actions: Array,
        crud: String,
        routeName: String,
        title: {
            type: String,
            default: ""
        },
        expandable: {
            type: String,
            default: ""
        },
        superFilters: {
            type: Array,
            default: null
        },
        only: {
            type: String,
            default: ""
        },
        settings: {
            type: Object,
            default: {}
        }
    },
    methods: {
        create() {
            this.$emit('create');
        },
        sort(field) {
            this.params.field = field
            this.params.direction = this.params.direction === "asc" ? "desc" : "asc"
        }

    },
    watch: {
        params: {
            handler(val) {



                let params = this.params

                console.log('rrrr')
                console.log(params)

                Object.keys(params).forEach(key => {
                    if (params[key] === "" || params[key] === null || params[key] == false) {
                        delete params[key]
                    }
                })

                this.$inertia.get(route(this.routeName), {params}, {
                    preserveState: true,
                    preserveScroll: true,
                    only: [this.only]
                })

            },
            deep: true
        }
    },
}
</script>

<style scoped>

.trData {
    background-color: #f4f6fa;
    border: 1px solid #e6e7e9;
}

</style>
