<template>

    <div class="flex flex-col" :class="isHeader ? 'my-2 px-2' : 'mb-5'" v-if="schema.form || schema.forms">
        <label v-if="!isHeader" :for="schema.form" class="font-medium text-sm text-gray-700" >{{ schema.label }} <span v-if="schema.required" class="text-red-600">*</span></label>
        <template v-if="isUpdatable(schema)">
            <div v-if="schema.type === 'text' || schema.type === 'number' || schema.type === 'email' || schema.type === 'tel' || schema.type === 'date' || schema.type === 'month' " >
                <input :id="schema.form" v-if="isUpdatable(schema)" v-model="form[schema.form]" :type="schema.type"
                       :class="dynamicClass(schema)" :placeholder="isHeader ?  schema.label : ''"
                       class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full" >
                <p v-else class="font-medium text-sm text-gray-700"> {{ form[schema.form] }} </p>
            </div>
            <div v-else-if="schema.type === 'files'" >
                <FileUploader v-model="form[schema.form]" withPreview="true" isDeleted="true" :files="form[schema.form]"></FileUploader>
            </div>
            <div v-else-if="schema.type === 'checkbox'" >
                <label class="inline-flex items-center mt-3">
                    <input v-model="form[schema.form]" type="checkbox" class="form-checkbox rounded h-5 w-5 text-blue-600">
                    <span class="ml-2 text-gray-700">{{ schema.label }}</span>
                </label>
            </div>
            <div v-else-if="schema.type === 'component'" >
                <components :componentName="schema.settings.componentName" :dataForm="form" :componentRole="isHeader ? 'filter' : 'store'" ></components>
            </div>
            <div v-else-if="schema.type === 'select-component'" >
                <select-component :componentName="schema.settings.componentName" v-model="form[schema.form]"></select-component>
<!--                <components :componentName="schema.settings.componentName" :dataForm="form" :componentRole="isHeader ? 'filter' : 'store'" ></components>-->
            </div>
            <p v-if="!isHeader" class="text-red-700">{{ errors[schema.form] }}</p>
        </template>
        <template v-else>
<!--            <dropdown-search-list :isUpdatable="false" :item_id="form[schema.form]" :apiUrl="schema.settings.apiUrl" @on-item-selected="onItemSelected" @on-item-reset="dropdownSelection = {}" :placeholder="schema.placeholder" v-if="schema.type === 'select'"></dropdown-search-list>-->
            <p>{{form[schema.form]}}</p>

        </template>
    </div>



</template>

<script>
import FileUploader from "@/Shared/Inputs/FileUploader"
import Components from "@/Shared/DataTable/Components/Components"
import SelectComponent from "@/Shared/DataTable/Components/SelectComponent"

export default {
    name: "InputBuilder",
    created() {
        if(this.schema.type === 'select-component' && this.form[this.schema.form] && Array.isArray(this.form[this.schema.form])) {
            this.form[this.schema.form] = this.form[this.schema.form].map(function(obj) {
                return obj['id'];
            })
        }
    },
    data() {
        return {
            dropdownSelection: {},
        }
    },
    props: {
        form: {
            type: Object,
            default: {},
        },
        schema: [Object, Array],
        isHeader: {
            type: Boolean,
            default: false,
        },
    },
    components: {
        FileUploader,
        Components,
        SelectComponent
    },
    methods: {
        isUpdatable(schema) {
            if (schema.updatable && !this.isHeader) {
                return this.form.id ? schema.updatable.update : schema.updatable.create
            } else {
                return true
            }
        },
        onItemSelected(itemSelected) {
            if(this.schema.type === 'select-multiple') {
                this.form[this.schema.form].push(itemSelected.id)
            }else {
                this.form[this.schema.form] = itemSelected
            }

        },
        onItemRemoved(item_id) {
            if(this.schema.type === 'select-multiple') {
                this.form[this.schema.form].splice(this.form[this.schema.form].indexOf(item_id), 1)
            }else {
                this.form[this.schema.form] = item_id
            }

        },
        dynamicClass(schema) {
            if(this.errors[schema.form] && !this.isHeader) {
                return 'border-red-600'
            }
        },

    },
    computed: {
        errors() {
            return this.$page.props.errors
        },
    },
}
</script>

<style scoped>

</style>
