<template>

    <div class="flex flex-col">
        <label :for="schema.form" class="font-medium text-sm text-gray-700" >{{ schema.label }} <span v-if="schema.required" class="text-red-600">*</span></label>
        <div>
            <div v-if="schema.type === 'checkbox'">
                <label class="inline-flex items-center mt-3">
                    <input v-model="form[schema.form]" type="checkbox" class="form-checkbox rounded h-5 w-5 text-blue-600">
                    <span class="ml-2 text-gray-700">{{ schema.label }}</span>
                </label>
            </div>
            <div v-else-if="schema.type === 'component'" >
                <components :componentName="schema.settings.componentName" :dataForm="form" componentRole="store" ></components>
            </div>
            <div v-else>
                <input :id="schema.form" v-model="form[schema.form]" :type="schema.type"
                       :class="dynamicClass(schema)"
                       class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full" >
            </div>

        </div>
        <p class="text-red-700">{{ errors[schema.form] }}</p>

    </div>

</template>

<script>
import Components from "@/Shared/DataTable/Components/Components"
export default {
    name: "InputBuilder",
    data() {
        return {
        }
    },
    props: {
        schema: [Array,Object],
        form: Object
    },
    components: {
        Components,
    },
    methods: {
        dynamicClass(schema) {
            if(this.errors[schema.form] && !this.isHeader) {
                return 'border-red-600'
            }
        }
    },
    computed: {
        errors() {
            return this.$page.props.errors
        }
    },
}
</script>

<style scoped>

</style>
