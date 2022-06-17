<template>
    <tfoot>
        <tr class="trData text-gray-600">
            <td :colspan="schemas.length > 1 ? schemas.length +1 : 3">
                <Pagination :links="data.links" :only="only"></Pagination>
            </td>
        </tr>
    </tfoot>
</template>

<script>

import Pagination from '@/Shared/Pagination';
export default {
    name: "DataTableFooter",
    props: {
        schemas: Array,
        data: Object,
        only: {
            type: String,
            default: ""
        },
    },
    components: {
        Pagination
    }
}
</script>

<style scoped>

.trData {
    background-color: #f4f6fa;
    border: 1px solid #e6e7e9;
}

</style>
