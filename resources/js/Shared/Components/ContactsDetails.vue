<template>
    <loading-animation v-if="!apiLoaded"></loading-animation>
    <Contact v-else :contact="contact" v-for="contact in itemList"></Contact>
    <p v-if="notContact">Aucun contact</p>
</template>

<script>
import axios from "axios";
import LoadingAnimation from "@/Shared/Components/LoadingAnimation";
import Contact from "@/Shared/Components/Contact";
export default {
    name: "ContactsDetails",
    data() {
        return {
            itemList: [],
            apiLoaded: false
        }
    },
    mounted() {
        this.getList()
    },
    components: {
        LoadingAnimation,
        Contact,
    },
    props: {
        apiRoute: String,
        data: {
            type: Object,
            default: {}
        },
        idPreview: Number,
        model: String
    },
    methods: {
        getList() {
            axios.get(route(this.apiRoute, [this.model,this.idPreview])).then(response => {
                this.itemList = response.data[0]
                this.apiLoaded = true
            })
        },
    },
    computed: {
        notContact() {
            return this.apiLoaded === true && this.itemList.length === 0
        }
    },
}
</script>

<style scoped>

</style>
