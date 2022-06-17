<template>

    <label class="font-medium text-sm text-gray-700 flex justify-between">{{ label }}
<!--        <badge-button v-if="can('setting.store')" @click="showModal = !showModal" :styleFilled="false">+ Ajouter</badge-button>-->
    </label>
    <select-search v-model="modelValue"
                   searchInApiBy="name"
                   labelDisplayed="name"
                   apiRoute="api.externals"
                   placeholder="Externes"
                   :withStored="can('setting.store')"
                   @storeOption="storeOption"
                   :key="keyReload"
    >
        <template #option="{option}">
            <div class="flex justify-between w-full">
                <p class="font-medium">{{ option.name }}</p>
            </div>
        </template>

        <template #singlelabel="{value}">
            <div class="multiselect-single-label">
                {{ value.name }}
            </div>
        </template>

    </select-search>

    <modal-simple :showModal="showModal" title="Externe" @submit="submit" @close="closeModal" :loading="form.processing">
        <template #content-modal>
            <div>
                <external-form v-model="form"></external-form>
            </div>

        </template>
    </modal-simple>

</template>

<script>
import SelectSearch from "@/Shared/Inputs/Select/SelectSearch"
import IconButton from "@/Shared/Components/IconButton";
import BadgeButton from "@/Shared/Components/BadgeButton";
import ModalSimple from "@/Shared/Modal/ModalSimple";
import ExternalForm from "@/Pages/Externals/ExternalForm";

export default {
    name: "ExternalSelect",
    data() {
        return {
            keyReload: 1,
            showModal: false,
            form: this.$inertia.form({
                id: null,
                name: '',
            })
        }
    },
    components: {
        SelectSearch,
        IconButton,
        BadgeButton,
        ModalSimple,
        ExternalForm
    },
    props: {
        modelValue: undefined,
        label: {
            type: String,
            default: ""
        }
    },
    emits: ['update:modelValue'],
    methods: {
        storeOption() {
            this.showModal = true

            if(this.modelValue) {
                this.form.id = this.modelValue
                let where = [];
                where['id'] = this.modelValue
                axios.get(route('api.externals', {
                    params: where,
                })).then(response => {
                    this.form.name = response.data[0][0].name
                });
            }else {
                this.form.reset()
            }
        },
        submit() {
            this.form.post(this.route('externals.store'), {
                preserveScroll: true,
                onSuccess: () => {
                    this.closeModal()
                    this.keyReload++
                }
            })
        },
        closeModal() {
            this.showModal = false
            this.form.reset()
        }
    },
    watch: {
        modelValue(newValue, oldValue) {
            this.$emit('update:modelValue', newValue)
        }
    },
}
</script>

<style scoped>

</style>
