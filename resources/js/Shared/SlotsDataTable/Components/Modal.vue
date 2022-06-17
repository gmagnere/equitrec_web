<template>

    <DialogModal :show="showModal" @close="closeModal">
        <template #title>
            <h1>Mise à jour</h1>
        </template>

        <template #content>

            <slot name="content-modal"></slot>

            <!--            <div class="rounded px-8 pt-6 mb-2">-->
            <!--                <template v-if="!isPreview" v-for="schema in schemas">-->
            <!--                    <input-builder :schema="schema" :form="form"></input-builder>-->
            <!--                </template>-->
            <!--                <template v-else>-->
            <!--                    <expandable-components :component="routeName" :idPreview="idPreview"></expandable-components>-->
            <!--                </template>-->
            <!--            </div>-->

        </template>

        <template #footer>
            <div class="flex justify-between">
                <slot name="footer-buttons"></slot>
            </div>
        </template>

    </DialogModal>

</template>

<script>
import DialogModal from "@/Jetstream/DialogModal";

export default {
    name: "Modal",
    components: {
        DialogModal,
    },
    props: {
        showModal: {
            type: Boolean,
            default: false
        },
    },
    methods: {
        closeModal() {
            this.$emit('close')
        },
        submit() {

        }
    },
}
</script>

<style scoped>

</style>
