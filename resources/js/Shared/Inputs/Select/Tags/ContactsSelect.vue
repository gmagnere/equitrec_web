<template>

    <div v-if="isUpdatable">

        <label class="font-medium text-sm text-gray-700 flex justify-between">{{ label }}
<!--            <badge-button v-if="can('contact.store')" @click="showModal = !showModal" :styleFilled="false">+ Ajouter</badge-button>-->
        </label>
        <select-search v-model="modelValue"
                       mode="tags"
                       searchInApiBy="name"
                       labelDisplayed="name"
                       apiRoute="api.contacts"
                       placeholder="Contacts"
                       @storeOption="storeOption"
                       :withStored="can('contact.store')"
        >

            <template #option="{option}">
                <div class="w-full">
                    <p class="flex items-center justify-between">
                        <!--                    <img class="img-is-user" src="https://randomuser.me/api/portraits/med/women/2.jpg" alt="">-->
                        {{ option.name }}
                        <span class="text-xs italic">{{ option.options.position }}</span>
                    </p>
                    <p class="flex items-center text-xs italic justify-between">
                        {{ option.options.email }}
                        <span class="text-xs italic text-red-600" v-if="option.options.is_important">À contacter</span>
                    </p>

                </div>
            </template>

            <template #tag="{option, handleTagRemove, disabled}">
                <div class="bg-is-user text-white rounded">
                    <div class="flex">
                        <!--                    <img class="img-is-user" src="https://randomuser.me/api/portraits/med/women/2.jpg" alt="">-->
                        <p class="self-center">{{ option.name }}</p>
                        <icon  @mousedown.prevent="handleTagRemove(option, $event)"
                               class="self-center cursor-pointer hover:text-red-600" name="x" h="4"></icon>
                    </div>
                </div>
            </template>
        </select-search>


        <modal-simple :showModal="showModal" title="Nouveau client" @submit="submit" @close="showModal = false" :loading="form.processing">
            <template #content-modal>
                <div>
                    <contact-form v-model="form"></contact-form>
                </div>

            </template>
        </modal-simple>

    </div>
    <div v-else>
        <contacts-with-modals :textCounter="data.length" :model="modelType" :idPreview="modelId" title=""></contacts-with-modals>
    </div>


</template>

<script>
import SelectSearch from "@/Shared/Inputs/Select/SelectSearch"
import Icon from "@/Shared/Components/Icon";
import BadgeButton from "@/Shared/Components/BadgeButton";
import ModalSimple from "@/Shared/Modal/ModalSimple";
import ContactsWithModals from "@/Shared/Components/ContactsWithModal"

export default {
    name: "CustomerSelect",
    data() {
        return {
            showModal: false,
            form: this.$inertia.form({
                name: '',
                position: '',
                address_list: [],
                phone: '',
                email: '',
                is_important: false,
                types: []
            })
        }
    },
    components: {
        SelectSearch,
        Icon,
        ModalSimple,
        ContactForm,
        BadgeButton,
        ContactsWithModals
    },
    props: {
        modelValue: undefined,
        label: {
            type: String,
            default: ""
        },
        isUpdatable : {
            type: Boolean,
            default: true,
        },
        data: {
            type: [Object,Array],
            default: []
        },
        modelType: {
            type: String,
            default: "true",
        },
        modelId: {
            type: Number,
            default: null,
        },
    },
    emits: ['update:modelValue'],
    methods: {
        submit() {
            this.form.post(this.route('contacts.store'), {
                preserveScroll: true,
                onSuccess: () => this.showModal = false,
            })
        },
        storeOption() {
            this.form.reset()
            this.showModal = true
        },
    },
    watch: {
        modelValue(newValue, oldValue) {
            this.$emit('update:modelValue', newValue)
        }
    },
}
</script>

<style scoped>

    .bg-is-user {
        padding: 5px 8px;
        background: #35495e;
        margin: 3px 3px 8px;
    }



</style>
