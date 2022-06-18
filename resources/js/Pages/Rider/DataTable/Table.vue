<template>
    <data-table  :colspanTitle="4" >
        <template #title>
            Liste des cavaliers
        </template>
        <template #columns-headers>
            <ColumnHeader></ColumnHeader>
            <ColumnHeader></ColumnHeader>
            <ColumnHeader></ColumnHeader>
            <ColumnHeader></ColumnHeader>
        </template>
        <template #rows>
            <row v-for="rider in form.riders " :key="rider.id">
                <column>{{rider.name}}</column>
                <column>

                </column>
                <column>

                </column>
                <column>

                </column>
            </row>
        </template>
    </data-table>
    <error-message  v-for="(error, key) in form.errors" :key="key" :message="error"></error-message>
    <loading-button
        @click="submit" text="Enregistrer" icon="save" styles="update" :loading="form.processing">
    </loading-button>
</template>

<script>
import DataTable from "@/Shared/SlotsDataTable/SlotsDataTable"
import Column from "@/Shared/SlotsDataTable/Components/Column"
import ColumnHeader from "@/Shared/SlotsDataTable/Components/ColumnHeader"
import Row from "@/Shared/SlotsDataTable/Components/Row"

import TextInput from "@/Shared/Inputs/TextInput";
import LoadingButton from "@/Shared/Components/LoadingButton";

import ErrorMessage from "@/Shared/Components/ErrorMessage";

export default {
    name: "Table",
    data() {
        return {
            form: this.$inertia.form({
                riders: this.riders,
            }),
        }
    },
    components: {
        DataTable,
        Column,
        ColumnHeader,
        Row,
        TextInput,
        LoadingButton,
        ErrorMessage
    },
    props: {
        riders: {
            type: Array,
            default: {}
        },
    },
    methods: {
        submit(){
            this.form.post(this.route('declarations.rate'), {
                preserveScroll: true,
                preserveState: true,
                onSuccess: () => {
                    this.close()
                }
            })
        }
    },
    watch: {
        workers(newValue) {
            console.log(newValue)
            this.form.workers = newValue
        }
    },
}
</script>

<style scoped>

</style>
