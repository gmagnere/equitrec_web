<template>
    <div :class="classBox">
        <label v-if="label" class="font-medium text-sm text-gray-700" :for="id"  :class="error ? 'text-red-700' : ''">{{ label }}:</label>

        <input v-if="isInputable" :id="id" ref="input"  v-bind="$attrs" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full"
               :type="type"
               :value="modelValue"
               :placeholder="placeholder"
               @input="$emit('update:modelValue', $event.target.value)"
        :class="error ? 'border-red-600' : ''"
        />
        <p v-else :class="classNotInputable">{{ rtnValue() }}</p>

        <div v-if="error" class="text-red-600">{{ error }}</div>
    </div>



</template>

<script>

export default {
    inheritAttrs: false,
    name: "TextInput",
    props: {
        id: {
            type: String,
            default() {
                return `text-input-` + Math.floor(Math.random() * 99999)
            },
        },
        type: {
            type: String,
            default: 'text',
        },
        value: [String, Number],
        label: String,
        placeholder: String,
        error: String,
        isInputable: {
            type: Boolean,
            default: true,
        },
        afterValue: {
            type: String,
            default: "",
        },
        classBox: {
            type: String,
            default: 'mb-5',
        },
        classNotInputable: {
            type: String,
            default: "font-semibold text-lg text-gray-700"
        },
        modelValue: undefined
    },
    methods: {
        rtnValue() {
            return this.modelValue == null ? "-" :  (this.modelValue + ' ' +  this.afterValue)
        }
    },
    watch: {
       /* value() {
            this.$emit('update:modelValue', this.value)
        }*/
    },
}
</script>

<style scoped>

</style>
