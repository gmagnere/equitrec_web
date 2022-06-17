<template>
<!--    <p> {{ componentName}}</p>-->
<!--    <input type="text" v-model="modelValue" @input="$emit('update:modelValue', $event.target.value)">-->

    <provider-select v-if="componentName === 'single-provider'" v-model="modelValue"></provider-select>
    <category-select v-else-if="componentName === 'single-category'" v-model="modelValue"></category-select>
    <order-status-select v-else-if="componentName === 'single-order-status'" v-model="modelValue"></order-status-select>
    <user-select v-else-if="componentName === 'single-user'" v-model="modelValue"></user-select>
    <customer-select v-else-if="componentName === 'single-customer'" v-model="modelValue"></customer-select>
    <site-type-select v-else-if="componentName === 'single-site-type'" v-model="modelValue"></site-type-select>
    <agency-select v-else-if="componentName === 'single-agency'" v-model="modelValue"></agency-select>
    <contacts v-else-if="componentName === 'tags-contacts'" v-model="modelValue"></contacts>
    <business-bet-presta v-else-if="componentName === 'single-business-bet-presta'" v-model="modelValue"></business-bet-presta>
    <setting-roles-select v-else-if="componentName === 'tags-setting-role'" v-model="modelValue"></setting-roles-select>


</template>

<script>

import ProviderSelect from "@/Shared/Inputs/Select/Single/ProviderSelect"
import CategorySelect from "@/Shared/Inputs/Select/Single/Catalog/CatalogCategorySelect"
import OrderStatusSelect from "@/Shared/Inputs/Select/Single/Order/OrderStatusSelect"
import UserSelect from "@/Shared/Inputs/Select/Single/UserSelect"
import CustomerSelect from "@/Shared/Inputs/Select/Single/CustomerSelect"
import SiteTypeSelect from "@/Shared/Inputs/Select/Single/Site/SiteTypeSelect"
import AgencySelect from "@/Shared/Inputs/Select/Single/AgencySelect"
import Contacts from "@/Shared/Inputs/Select/Tags/ContactsSelect"
import BusinessBetPresta from "@/Shared/Inputs/Select/Single/Business/Bet/BusinessBetPrestaSelect"
import SettingRoleSelect from "@/Shared/Inputs/Select/Single/Setting/SettingRoleSelect"
import SettingRolesSelect from "@/Shared/Inputs/Select/Tags/Setting/SettingRolesSelect";

export default {
    name: "SelectComponent",
    props: {
        componentName: {
            type: String,
            default: "store"
        },
        modelValue: undefined
    },
    components: {
        ProviderSelect,
        CategorySelect,
        OrderStatusSelect,
        UserSelect,
        CustomerSelect,
        SiteTypeSelect,
        AgencySelect,
        Contacts,
        BusinessBetPresta,
        SettingRolesSelect
    },
    watch: {
        modelValue(newValue, oldValue) {
            this.$emit('update:modelValue', newValue)
        }
    },
}
</script>

<style scoped>

</style>
