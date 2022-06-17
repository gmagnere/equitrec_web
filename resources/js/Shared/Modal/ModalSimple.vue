<template>

    <DialogModal :show="showModal" @close="closeModal">
        <template #title>
            <h1>{{ title }}</h1>
        </template>

        <template #content>

            <slot name="content-modal"></slot>

        </template>

        <template #footer>
            <div class="flex justify-between">
                <LoadingButton @click="submit" :text=textButton icon="save" styles="update" :loading="loading"></LoadingButton>
            </div>
        </template>

    </DialogModal>

</template>

<script>
import DialogModal from "@/Jetstream/DialogModal";
import LoadingButton from "@/Shared/Components/LoadingButton";

export default {
    name: "Modal",
    components: {
        DialogModal,
        LoadingButton
    },

    props: {
        showModal: {
            type: Boolean,
            default: false
        },
        title: {
            type: String,
            default: "Mise à jour"
        },
        loading: {
            type: Boolean,
            default: false
        },
        textButton: {
            type: String,
            default: "Enregistrer"
        }
    },
    emits: ['submit', 'close'],
    methods: {
        closeModal() {
            this.$emit('close')
        },
        submit() {
            this.$emit('submit')
        }
    },
}
</script>

<style scoped>

</style>
