<template>
    <AppLayout title="Dashboard">
        <template #header>
            Les cavaliers
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <rider-table :riders="riders"></rider-table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import RiderTable from "@/Pages/Rider/DataTable/Table";
import AppLayout from '@/Layouts/AppLayout.vue';
export default {
    name: "Index",
    components: {
        AppLayout,
        RiderTable,
    },

    props: {
        riders: Array,
    },
}
</script>

<style scoped>

</style>
