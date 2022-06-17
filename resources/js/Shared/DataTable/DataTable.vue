<template>

    <div class="bg-white max-w-screen-sm md:max-w-full overflow-x-auto inline-block w-full shadow-lg border rounded-lg mt-2">
        <table class="text-center w-full leading-normal overflow-auto table-auto">

            <data-table-header :routeName="routeName" :schemas="schemas" :actions="actions"
                               :crud="crud" @create="create" :title="title"
                               :expandable="expandable"
                               :superFilters="superFilters"
                               :settings="settings"
                               :only="only"
            ></data-table-header>

            <tbody>


            <template v-for="data in globalData" :key="data.id" v-if="globalData">
                <tr
                    class="border-b border-gray-200 color-blue-custom">
                    <data-table-row :schemas="schemas" :data="data" :crud="crud" :expandable="expandable" :options="options" :routeName="routeName" @onLineSelected="onLineSelected" @modalPreview="modalPreview"></data-table-row>

                    <!-- ****** ACTIONS ******* -->
                    <td v-if="crud.includes('u') || crud.includes('d') || actions" class="px-5 py-5 border-b border-gray-200 text-sm " :colspan="schemas.length > 1 ? 1 : 2">
                        <div class="flex justify-center">
                            <div v-if="actions">
                                <icon @click="doAction(action, data)" :name="action.icon" v-for="action in actions" class="mr-6 cursor-pointer  hover:text-purple-500 transform hover:scale-110"></icon>
                            </div>

                            <div v-if="crud.includes('u')"
                                 class="w-6 mr-6 cursor-pointer transform hover:text-purple-500 hover:scale-110">
                                <svg @click="update(data)" xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                            </div>


                        </div>
                    </td>
                    <!-- ****** FIN ACTIONS ******* -->

                </tr>
                <tr v-if="data.expandableVisible">
                    <td :colspan="schemas.length + ((crud.includes('u') || crud.includes('d') || actions ? 1 : 0))">
                        <div class="shadow-lg">
                            <expandable-components :component="expandable" :data="data"></expandable-components>
                        </div>
                    </td>
                </tr>
            </template>
            <template v-else>
                <data-table-empty-row :crud="crud" :schemas="schemas" @create="create" ></data-table-empty-row>
            </template>


            </tbody>

            <data-table-footer :schemas="schemas" :data="baseData" :only="only"></data-table-footer>

        </table>
    </div>


    <DialogModal v-if="showModal" :show="showModal" @close="showModal = !showModal">
        <template #title>
            <h1> {{ titleModal }}</h1>
        </template>

        <template #content>
            <div class="rounded px-8 pt-6 mb-2">
                <template v-if="!isPreview" v-for="schema in schemas">
                    <input-builder :schema="schema" :form="form"></input-builder>
                </template>
                <template v-else>
                    <expandable-components :component="routeName" :idPreview="idPreview"></expandable-components>
                </template>
            </div>

        </template>

        <template v-if="!isPreview" #footer>
            <div class="flex justify-between">
                <div>
                    <LoadingButton @click="store" v-if="form.id" text="Enregistrer" icon="save" styles="update" :loading="form.processing"></LoadingButton>
                    <LoadingButton @click="store" v-else text="Ajouter" icon="plus-circle" styles="create" :loading="form.processing"></LoadingButton>
                </div>
                <button  @click="destroy(form.id)" v-if="crud.includes('d') && form.id" class="text-red-600 hover:underline" tabindex="-1" type="button">Supprimer</button>
            </div>
        </template>

    </DialogModal>

</template>

<script>

import DataTableHeader from "@/Shared/DataTable/Components/DataTableHeader";
import DataTableRow from "@/Shared/DataTable/Components/DataTableRow";
import DataTableEmptyRow from "@/Shared/DataTable/Components/DataTableEmptyRow";
import DataTableFooter from "@/Shared/DataTable/Components/DataTableFooter";
import InputBuilder from "@/Shared/DataTable/Components/InputBuilder"
import ExpandableComponents from "@/Shared/DataTable/Components/ExpandableComponents"

import DialogModal from "@/Jetstream/DialogModal";
import LoadingButton from "@/Shared/Components/LoadingButton";
import Icon from "../Components/Icon";

export default {
    name: "DataTable",
    data() {
        return {
            titleModal: "",
            showModal: false,
            globalData: 'data' in this.baseData ? this.baseData.data : this.baseData,
            form: this.$inertia.form({}),
            isPreview: false,
            idPreview: null,
        }
    },
    components: {
        Icon,
        DataTableHeader,
        DataTableRow,
        DataTableEmptyRow,
        DataTableFooter,
        DialogModal,
        InputBuilder,
        LoadingButton,
        ExpandableComponents
    },
    emits: ['onLineSelected', 'print', "open", 'validate'],
    props: {
        schemas: Array,
        settings: {
            type: Object,
            default: {}
        },
        actions: Array,
        crud:  {
            type: String,
            default: ""
        },
        routeName: String,
        title: String,
        baseData: Object,
        expandable: {
            type: String,
            default: ""
        },
        superFilters: {
            type: Array,
            default: null
        },
        options: {
            type: Object,
            default: null
        },
        only: {
            type: String,
            default: ""
        },
    },
    methods: {
        create() {
            let currentForm = this.form
            this.schemas.forEach(function (schema) {
                if(schema.hasOwnProperty("relations")) {
                    currentForm[schema.form] = []
                }else if(schema.hasOwnProperty("forms")) {
                    schema.forms.forEach(function (form) {
                        currentForm[form] = []
                    })

                }else {
                    if(schema.type === 'select-component') {
                        if(schema.mode === 'tags') {
                            currentForm[schema.form] = []
                        }else {
                            currentForm[schema.form] = ""
                        }
                    }else {
                        currentForm[schema.form] = ""
                    }

                }
            })
            this.form = currentForm
            this.form.id = ""

            this.titleModal = "Création"
            this.showModal = true
            this.isPreview = false
        },
        update(dataRow) {
            let currentForm = this.form
            this.schemas.forEach(function (schema) {
                if(schema.hasOwnProperty("relations")) {
                    currentForm[schema.form] = dataRow[schema.form].map(function(obj) {
                        return obj['id'];
                    })
                }else if(schema.hasOwnProperty("forms")) {
                    schema.forms.forEach(function (form) {
                        currentForm[form] = dataRow[form]
                    })

                }else {
                    currentForm[schema.form] = dataRow[schema.form]
                }
            })
            this.form = currentForm
            this.form.id = dataRow['id']

            this.titleModal = "Modification"
            this.showModal = true
            this.isPreview = false
        },
        modalPreview(modelId) {
            this.titleModal = "Aperçu"
            this.showModal = true
            this.isPreview = true
            this.idPreview = modelId
        },
        store() {
            this.form.processing = true
            this.$inertia.post(route(this.routeName + '.store'), this.form, {
                preserveScroll: true,
                onSuccess: () => {
                    this.form.reset()
                    this.form.processing = false
                    this.showModal = !this.showModal
                },
                onError: () => {
                    this.form.processing = false
                }
            });
        },
        destroy(data_id) {
            if (window.confirm("Êtes-vous sur de vouloir supprimer cette donnée ? Cette action est irréversible ")) {
                this.$inertia.delete(route(this.routeName + '.destroy', data_id), {
                    onSuccess: () => {
                        this.form.reset()
                        this.showModal = !this.showModal
                    }
                })
            }
        },
        closeModal() {
            this.showModal = !this.showModal
        },
        doAction(action, data) {
            console.log()
            let emit = action.emit
            this.$emit(emit, data[action.param])
        },
        onLineSelected(value) {
            this.$emit('onLineSelected', value)
        },
    },
    watch: {
        baseData() {
            this.globalData = 'data' in this.baseData ? this.baseData.data : this.baseData
        },
        showModal() {
            if (this.showModal) {
                document.body.style.overflow = 'hidden'
            } else {
                document.body.style.overflow = null
            }
        }
    },
}
</script>

<style scoped>

    .color-blue-custom:hover {
        background-color: #f4f6fa;
    }

</style>
