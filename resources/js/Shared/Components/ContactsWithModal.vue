<template>

    <span v-if="title" class="text-gray-700">{{ title }}</span>
    <div class="pl-2 flex cursor-pointer items-center hover:text-blue-500" @click="showModal = ! showModal">
        <p class="font-bold hover:text-blue-500">{{ textCounter }}</p>
        <icon name="people-call"></icon>
    </div>


    <DialogModal :show="showModal" @close="showModal = !showModal">
        <template #title>
            <h1>Contacts</h1>
        </template>

        <template #content>
            <contacts-details apiRoute="api.contactsForModel" :model="model" :idPreview="idPreview"></contacts-details>
        </template>

    </DialogModal>

</template>

<script>
import DialogModal from "@/Jetstream/DialogModal"
import ContactsDetails from "@/Shared/Components/ContactsDetails";
import Icon from "@/Shared/Components/Icon";

export default {
    name: "ContactsWithModal",
    data() {
        return {
            showModal: false
        }
    },
    components: {
        DialogModal,
        ContactsDetails,
        Icon
    },
    props: {
        textCounter: [String, Number],
        model: String ,
        idPreview: Number,
        title: {
            type: String,
            default: "Contacts"
        }
    },
}
</script>

<style scoped>

</style>
