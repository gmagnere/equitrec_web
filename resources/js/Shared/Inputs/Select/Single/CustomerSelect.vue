<template>

    <label class="font-medium text-sm text-gray-700 flex justify-between" :class="error ? 'text-red-700' : ''">{{ label }}</label>
    <select-search v-model="modelValue"
                   searchInApiBy="name"
                   labelDisplayed="name"
                   apiRoute="api.customers"
                   placeholder="Clients"
                   :withStored="can('customer.store')"
                   @storeOption="storeOption"
                   :key="keyReload"
                   :error="error"
    >
        <template #option="{option}">
            <div>
                <p>{{ option.name }}</p>
            </div>
        </template>
    </select-search>



    <modal-simple :showModal="showModal" title="Client" @submit="submit" @close="showModal = false" :loading="form.processing">
        <template #content-modal>
            <div>
                <customer-form v-model="form"></customer-form>
            </div>

        </template>
    </modal-simple>


</template>

<script>
import SelectSearch from "@/Shared/Inputs/Select/SelectSearch"
import BadgeButton from "@/Shared/Components/BadgeButton";
import ModalSimple from "@/Shared/Modal/ModalSimple";
import CustomerForm from "@/Pages/Customers/CustomerForm";

export default {
    name: "CustomerSelect",
    data() {
        return {
            keyReload: 1,
            showModal: false,
            form: this.$inertia.form({
                id: null,
                name: '',
                address_list: [],
                contacts: [],
            })
        }
    },
    components: {
        SelectSearch,
        BadgeButton,
        ModalSimple,
        CustomerForm,
    },
    props: {
        modelValue: undefined,
        label: {
            type: String,
            default: ""
        },
        error: String,
    },
    emits: ['update:modelValue'],
    methods: {
        storeOption() {


            if(!this.isEmpty(this.modelValue)) {
                this.form.id = this.modelValue
                let where = [];
                where['id'] = this.modelValue
                axios.get(route('api.customers', {
                    params: where,
                })).then(response => {
                    this.form.name = response.data[0][0].name
                    this.form.address_list = response.data[0][0].address_list
                    this.form.contacts = response.data[0][0].contacts
                    this.showModal = true
                });
            }else {
                this.form.reset()
                this.showModal = true
            }
        },
        submit() {
            this.form.post(this.route('customers.store'), {
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
