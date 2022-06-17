<template>

    <loading-animation v-if="!apiLoaded"></loading-animation>
    <div :class="classBox" v-else>
        <label class="font-medium text-sm text-gray-700" >Produit</label>
        <Multiselect id="catalog_id" label="label" @select="onSelectProductsChange" :options="catalogs" :searchable="true" track-by="label" placeholder="Rechercher un produit" v-model="catalog_id" />
        <loading-button @click="displayBarCodeReader = ! displayBarCodeReader" class="mt-1" text="Code barre" styles="relation"
                        icon="qrcode"></loading-button>
        <barcode-reader v-if="displayBarCodeReader" @decode="onSelectProductsChange"></barcode-reader>

        <p v-if="feedbackProduct !== ''" class="text-xl text-white bg-red-500 text-center border rounded">{{ feedbackProduct }}</p>

        <div v-if="catalogDetail" class="mt-5">
            <product :product="catalogDetail" :withStock="withStock"></product>
        </div>

    </div>


</template>

<script>
import Multiselect from '@vueform/multiselect';
import BarcodeReader from "@/Shared/Components/BarcodeReader";
import LoadingButton from "@/Shared/Components/LoadingButton";
import Product from "@/Shared/Components/Product";
import axios from "axios";
import LoadingAnimation from "@/Shared/Components/LoadingAnimation";
export default {
    name: "SelectProduct",
    data() {
        return {
            catalogs: [],
            catalogPreview: [],
            catalog_id: null,
            catalogDetail: null,
            displayBarCodeReader: false,
            apiLoaded: false,
            feedbackProduct: ""
        }
    },
    components: {
        Multiselect,
        BarcodeReader,
        LoadingButton,
        Product,
        LoadingAnimation
    },
    props: {
        selectedLocation: {
            type: [String, Number],
            default: null
        },
        withStock: {
            type: Boolean,
            default: false
        },
        classBox: {
            type: String,
            default: ""
        },
        withTrashed: {
            type: Boolean,
            default: true,
        },
        defaultCatalogId: {
            type: [String, Number],
            default: null
        }
    },
    mounted() {
        this.getList()
    },
    methods: {
        onSelectProductsChange(catalog_id) {
            this.catalog_id = catalog_id
            this.getCatalogDetail()
            this.$emit('update:modelValue', this.catalog_id)
        },
        getCatalogDetail() {
            this.catalogDetail = this.catalogPreview.find(x => x.id == this.catalog_id || x.part_number == this.catalog_id)
            if(this.catalogDetail) {
                this.catalog_id = this.catalogDetail.id
                this.feedbackProduct = ""
                this.$emit('getCatalogDetail', this.catalogDetail)
            }else {
                this.feedbackProduct = "Référence: " + this.catalog_id + " introuvable ou indisponible dans le stock sélectionné"
                this.catalog_id = null
            }
        },
        getList() {
            let apiWithOrNotTrashed = this.withTrashed ? '/api/catalogPluck/' : '/api/catalogPluckWithoutTrashed/'
            //let apiUrl = this.selectedLocation ?  '/api/catalogPluck/' + this.selectedLocation : '/api/catalogPluck/'
            let apiUrl = this.selectedLocation ?  apiWithOrNotTrashed + this.selectedLocation : apiWithOrNotTrashed
            axios.get(apiUrl).then(response => {
                this.catalogs= response.data[0]
                this.catalogPreview= response.data[1]
                this.apiLoaded = true

                if(this.defaultCatalogId) {
                    this.catalog_id = this.defaultCatalogId
                    this.getCatalogDetail()
                    this.onSelectProductsChange(this.catalog_id)
                }


            })
        }
    },
}
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
<style scoped>

</style>
