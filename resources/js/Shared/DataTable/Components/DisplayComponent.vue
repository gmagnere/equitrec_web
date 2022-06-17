<template>

    <contacts-select v-if="componentName === 'contacts'" :isUpdatable="false" :data="data.contacts" :modelType="options.modelType" :modelId="data.id"></contacts-select>
    <div v-else-if="componentName === 'roles'">
        <chips v-for="role in data.roles" styleName="blue">{{ role.name }}</chips>
    </div>

</template>

<script>

import ContactsSelect from "@/Shared/Inputs/Select/Tags/ContactsSelect"
import Chips from "@/Shared/Components/Chips";


export default {
    name: "DisplayComponent",
    props: {
        componentName: {
            type: String,
            default: "store"
        },
        data: Object,
        options: Object,
    },
    components: {
        ContactsSelect,
        Chips
    },
}
</script>

<style scoped>

</style>
