<template>

    <template v-if="componentRole === 'reader'">
        <div :class="classBoxReader">
            <div v-for="addressItem in dataForm.address_list" class="mb-2" :class="classReader">
                <p>{{ addressItem.address }}</p>
                <div class="flex justify-center">
                    <span class="mr-1">
                       <p>{{ addressItem.postal_code }}</p>
                    </span>
                        <p>{{ addressItem.city }}</p>
                </div>

            </div>
        </div>


    </template>
    <template v-else-if="componentRole === 'store'">
        <badge-button @click="addItem">+ Ajouter</badge-button>
        <div v-for="(addressItem, index) in dataForm.address_list" class="mt-5" >
            <div class="flex">
                <icon @click="removeItem(index)" class="self-center cursor-pointer transform hover:scale-110 text-red-700 h-6 w-6 mr-2" name="x"></icon>
                <div>
                    <text-input classBox="mr-1" v-model="addressItem.address" placeholder="Adresse"></text-input>
                    <div class="mt-1 flex justify-between">
                        <text-input classBox="mr-1" v-model="addressItem.postal_code" placeholder="Code postal"></text-input>
                        <text-input classBox="mr-1" v-model="addressItem.city" placeholder="Ville"></text-input>
                    </div>
                </div>
            </div>



        </div>
    </template>

    <template v-else-if="componentRole === 'filter'">
        <text-input v-model="dataForm.address" placeholder="Adresse"></text-input>
        <text-input v-model="dataForm.postal_code" placeholder="Code postal"></text-input>
        <text-input v-model="dataForm.city" placeholder="Ville"></text-input>
    </template>

</template>

<script>
import Label from "@/Shared/Inputs/Label";
import BadgeButton from "@/Shared/Components/BadgeButton";
import TextInput from "@/Shared/Inputs/TextInput";
import Icon from "@/Shared/Components/Icon"

export default {
    name: "Address",
    props: {
        dataForm: {
            type: Object,
            default: {}
        },
        componentRole: {
            type: String,
            default: "store"
        },
        classBoxReader: {
            type: String,
            default: ""
        },
        classReader: {
            type: String,
            default: ""
        }
    },
    components: {
        Label,
        BadgeButton,
        TextInput,
        Icon
    },
    created() {
        if(this.dataForm.address_list) {
            if (this.dataForm.address_list.length === 0) {
                this.addItem()
            }
        }



        if(!this.dataForm.id && !this.componentRole === 'filter' || !this.componentRole === 'reader') {
            this.dataForm.address_list = []
            this.addItem()
        }

    },
    methods: {
        addItem() {
            this.dataForm.address_list.push({
                id: '',
                address: '',
                postal_code: '',
                city: '',
            })
        },
        removeItem(index) {
            this.dataForm.address_list.splice(index, 1)
        }
    },
}
</script>

<style scoped>

</style>
