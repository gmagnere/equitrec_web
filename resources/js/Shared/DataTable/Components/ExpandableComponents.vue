<template>

    <providers-catalog v-if="component === 'ProvidersCatalog'" :dataComponent="data" ></providers-catalog>
    <providers-details v-else-if="component === 'providers'" apiRoute="api.contactsForModel" :idPreview="idPreview"></providers-details>
    <contacts-details v-else-if="component === 'sites' || component === 'customers'" :model="component" apiRoute="api.contactsForModel" :idPreview="idPreview"></contacts-details>
    <site-catalog v-else-if="component === 'SiteCatalog'" :dataComponent="data"></site-catalog>

</template>

<script>
import ProvidersCatalog from "@/Pages/Catalog/ProvidersCatalog"
import ProvidersDetails from "@/Pages/Providers/ProvidersDetails";
import ContactsDetails from "@/Shared/Components/ContactsDetails";
import SiteCatalog from "@/Pages/SitesPhases/SiteCatalog";

export default {
    name: "ExpandableComponents",
    props: {
        component: String,
        idPreview: Number,
        data: {
            type: Object,
            default: {}
        }
    },
    components: {
        SiteCatalog,
        ProvidersCatalog,
        ProvidersDetails,
        ContactsDetails,
    }
}
</script>

<style scoped>

</style>
