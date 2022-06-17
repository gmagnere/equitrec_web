<template>
    <div  v-for="schema in schemas" class="mx-5">
        <input-builder :schema="schema" :form="params" :isHeader="true"></input-builder>
    </div>
</template>

<script>
import InputBuilder from "@/Shared/DataTable/Components/InputBuilder";
export default {
    name: "Filters",
    data() {
        return {
            params: {},
        }
    },
    props: {
        schemas: Array,
        routeName: String,
    },
    components: {
        InputBuilder,
    },
    watch: {
        params: {
            handler(val) {


                let params = this.params
                Object.keys(params).forEach(key => {
                    if (params[key] === "" || params[key] === null || params[key] == false) {
                        delete params[key]
                    }
                })

                this.$inertia.get(route(this.routeName), {params}, {
                    preserveState: true,
                    preserveScroll: true
                })

            },
            deep: true
        }
    },

}
</script>

<style scoped>

</style>
