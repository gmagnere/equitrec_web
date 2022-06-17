<template>

    <DialogModal :show="show" @close="close">
        <template #title>
            <h1>  </h1>
        </template>

        <template #content>

            {{ form }}

            <template v-for="schema in schemas">

                <text-input :schema="schema" :form="form" ></text-input>

            </template>

        </template>

        <template #footer>
            <button
                type="submit"
                class="flex text-lg bg-green-600 px-5 py-3 text-sm shadow-sm font-medium tracking-wider border text-green-100 rounded hover:shadow-lg hover:bg-green-700">
                <span class="ml-2">Ajouter</span>
            </button>


        </template>

    </DialogModal>

</template>

<script>
import DialogModal from "@/Jetstream/DialogModal";
import TextInput from "@/Shared/Inputs/TextInput"

export default {
    name: "DataTableModalStore",
    data() {
        return {
            titleModal: "",
            form: this.$inertia.form({
            }),
        }
    },
    created() {

        let form = this.form
        let formToStore = this.formToStore

        this.schemas.forEach(function (schema) {
            form[schema.form] = formToStore[schema.form]
        })

        form["id"] = formToStore.id

        this.form = form
    },
    props: {
        schemas: Array,
        formToStore: Object,

        show: Boolean
    },
    components: {
        DialogModal,
        TextInput,
    },
    methods: {
        close() {
            this.$emit('close')
        },

    },
}
</script>

<style scoped>

</style>
