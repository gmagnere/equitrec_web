<template>

    <div class="bg-white items-center p-2 rounded-xl shadow border">
        <div class="flex">
            <medias-preview :files="product.pictures"></medias-preview>
            <div class="flex justify-center items-center flex-grow p-3">
                <div>
                    <div class="font-semibold text-gray-700">
                        <a @click="viewRelation(product.id)" href="#">{{ product.part_number }} - {{ product.product_name }}</a>
                    </div>
                    <div v-if="product.description" class="mt-1">
                        <p class="font-semibold text-gray-700 italic text-xs">{{ product.description }}</p>
                    </div>
                </div>
                <div class="flex text-black">
                    <div v-if="product.category"
                         :style="{ backgroundColor: product.category.color}"
                         class="border-gray-500 text-sm shadow py-1 ml-3 px-3 rounded self-center">
                        {{ product.category.label }}
                    </div>
                    <medias-preview class="self-center" :files="product.technical_sheet"></medias-preview>
                    <div v-if="withStock" class="flex items-center ml-6 justify-center space-x-4">
                        <loading-animation v-if="!apiInventoryLoad"></loading-animation>
                        <div class="flex items-center" v-else>
                            <p v-if="inventories.length === 0" class="text-red-600 font-semibold">Aucune pièces en stock</p>
                            <div v-else class="flex items-center">
                                <p class="text-gray-700 font-semibold">Stocks: </p>
                                <div v-for="item in inventories" class="border-r-2 pl-2 pr-2 text-gray-700 font-semibold">
                                    {{item.location.label}}: {{item.inventory_on_hand}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



</template>

<script>
import MediasPreview from "@/Shared/Components/MediasPreview";
import LoadingAnimation from "@/Shared/Components/LoadingAnimation";
import axios from "axios";
export default {
    name: "Product",
    data() {
        return {
            apiInventoryLoad: false,
            inventories: []
        }
    },
    props: {
        product: Object,
        withStock: {
            type: Boolean,
            default: false
        },
        display: {
            type: Object,
            default: {}
        },
        isClickable: {
            type: Boolean,
            default: true
        }

    },
    components: {
        MediasPreview,
        LoadingAnimation
    },
    mounted() {
        this.getInventory()
    },
    methods: {
        viewRelation(catalog_id) {
            if(this.isClickable) {
                let myWindow = window.open('/catalog?params[id]=' + catalog_id, "_blank");
                myWindow.focus();
            }

        },
        getInventory() {
            if(this.withStock) {
                this.inventories = {}
                this.apiInventoryLoad = false
                axios.get(route('api.globalInventory', this.product.id)).then(response => {
                    this.apiInventoryLoad = true
                    this.inventories= response.data[0]
                })
            }
        }
    },
    watch: {
        product(newValue, oldValue) {
            this.getInventory()
        }
    },
}
</script>

<style scoped>

</style>
