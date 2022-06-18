<template>
<!--    {{componentName}} / {{componentRole}} / {{dataForm}}-->

    <business-address v-if="componentName === 'business.address'" :dataForm="dataForm" :componentRole="componentRole"></business-address>
    <billing-dates v-else-if="componentName === 'business.billingDates'" :dataForm="dataForm" :componentRole="componentRole"></billing-dates>
    <site-billing-date v-else-if="componentName === 'sites.billingDate'" :dataForm="dataForm" :componentRole="componentRole"></site-billing-date>
    <site-dates v-else-if="componentName === 'sites.dates'" :dataForm="dataForm" :componentRole="componentRole"></site-dates>
    <address-list v-else-if="componentName === 'global.address'" :dataForm="dataForm" :componentRole="componentRole"></address-list>
    <contact-types v-else-if="componentName === 'contact.contactTypes'" :dataForm="dataForm" :componentRole="componentRole" ></contact-types>
</template>

<script>
import AddressList from "@/Shared/Inputs/Address"


export default {
    name: "Components",
    props: {
        componentName: String,
        dataForm: Object,
        componentRole: {
            type: String,
            default: "store"
        }
    },
    components: {
        BusinessAddress,
        BillingDates,
        SiteDates,
        SiteBillingDate,
        AddressList,
        ContactTypes
    }
}
</script>

<style scoped>

</style>
