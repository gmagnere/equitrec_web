<template>

    <tr>
        <td class="py-5" :colspan="schemas.length + 2">
            <div class="flex justify-center">
                <p class="text-md self-center mr-2 text-gray-600">
                    Aucune donnée en base
                </p>

                <button
                    v-if="crud.includes('c')"
                    @click="create"
                    class="flex text-gray-600 px-5 py-2 text-md  rounded hover:bg-green-700 hover:text-white">
                    <icon name="plus-circle"></icon>
                    <span class="text-base ml-2">Ajouter</span>
                </button>
            </div>

        </td>
    </tr>

</template>

<script>
import Icon from "@/Shared/Components/Icon"
export default {
    name: "DataTableEmptyRow",
    components: {
        Icon
    },
    props: {
        schemas: Array,
        crud: String
    },
    methods: {
        create() {
            this.$emit('create');
        }
    },
}
</script>

<style scoped>

</style>
