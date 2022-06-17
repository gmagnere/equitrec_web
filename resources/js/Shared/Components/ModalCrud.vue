<template>

    <DialogModal :show="showModal" @close="showModal = !showModal">
        <template #title>
            <h1 v-if="baseData.id">Mise à jour</h1>
            <h1 v-else>Création</h1>
        </template>

        <template #content>
            <template v-for="schema in schemas.schemasCrud">
                <InputBuilder class="mb-4" :schema="schema" :form="form"></InputBuilder>
            </template>
        </template>

        <template #footer>
            <div class="flex justify-between">
                <div>
                    <LoadingButton v-if="baseData.id" @click="store" text="Enregistrer" icon="save" styles="update" :loading="form.processing"></LoadingButton>
                    <LoadingButton v-else @click="store" text="Ajouter" icon="plus-circle" styles="create" :loading="form.processing"></LoadingButton>
                </div>
            </div>
        </template>


    </DialogModal>

</template>

<script>
import DialogModal from "@/Jetstream/DialogModal"
import InputBuilder from "@/Shared/Components/InputBuilder";
import LoadingButton from "@/Shared/Components/LoadingButton";

export default {
    name: "ModalCrud",
    data() {
        return {
            form: this.$inertia.form({})
        }
    },
    created() {
        let currentForm = this.form
        let baseData = this.baseData
        this.schemas.schemasCrud.forEach(function (schema) {
            if(schema.hasOwnProperty("relations")) {
                currentForm[schema.form] = []
            }else if(schema.hasOwnProperty("forms")) {
                schema.forms.forEach(function (form) {
                    currentForm[form] = []
                })

            }else {
                currentForm[schema.form] = ""
            }
        })

        this.form = currentForm
        this.form.id = ""
    },
    components: {
        DialogModal,
        InputBuilder,
        LoadingButton
    },
    emits: ['reload'],
    props: {
        showModal: {
            type: Boolean,
            default: false
        },
        routeStore: String,
        schemas: [Array,Object],
        inputValue: [String, Number],
        baseData: [Array,Object]
    },
    methods: {
        store() {
            this.form['id'] = this.baseData.id
            this.form.processing = true
            this.$inertia.post(route(this.schemas.settings.routeStore), this.form, {
                preserveScroll: true,
                onSuccess: () => {
                    this.form.reset()
                    this.form.processing = false
                    this.$emit('reload')
                },
                onError: () => {
                    this.form.processing = false
                }
            });
        },
    },
    watch: {
        showModal(newValue, oldValue) {
            // this.form.name = this.inputValue

            let baseData = this.baseData
            let currentForm = this.form

            this.schemas.schemasCrud.forEach(function (schema) {
                currentForm[schema.form] = baseData[schema.form]
            })

            this.form = currentForm
        }
    },
}
</script>

<style scoped>

</style>
