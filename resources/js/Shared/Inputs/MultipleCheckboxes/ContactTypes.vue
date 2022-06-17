<template>

    <loading-animation v-if="!apiLoaded"></loading-animation>
    <div v-else  class="flex flex-wrap justify-center mt-3">
        <label class="inline-flex items-center mt-3 mr-3" v-for="type in types">
            <input v-model="types_selected" type="checkbox" :value="type.id" class="form-checkbox rounded h-5 w-5 text-blue-600">
            <span class="ml-2 text-gray-700">
            {{ type.label }}
        </span>
        </label>
    </div>


</template>

<script>
import axios from "axios";
import LoadingAnimation from "@/Shared/Components/LoadingAnimation";

export default {
    name: "ContactTypes",
    data() {
        return {
            apiLoaded: false,
            types_selected: [],
            types: []
        }
    },
    components: {
        LoadingAnimation,
    },
    props: {
        modelValue: undefined
    },
    created() {
      this.getContactTypes()
    },
    methods: {
        getContactTypes() {
            axios.get(route('api.contactTypes')).then(response => {
                this.apiLoaded = true
                this.types = response.data[0]
                this.types_selected = this.modelValue
            })
        },
    },
    watch: {
        types_selected(newValue, oldValue) {
            this.$emit('update:modelValue', newValue)
        }
    },
}
</script>

<style scoped>

</style>
