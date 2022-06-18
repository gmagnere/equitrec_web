<template>
    <div class="flex relative justify-start	">
        <Multiselect
            v-model="value"
            v-bind="settings"
            class="multiselectStyle w-full"
            ref="multiselecttest"
            @search-change="searchChange"
        >

            <template v-slot:option="{ option }">
                <slot name="option" :option="option" />
<!--                <icon-button @click="editOption" iconName="pencil" class="absolute right-3" h="4" w="4" classes="hover:scale-110 hover:text-blue-500"></icon-button>-->
            </template>

            <template v-slot:singlelabel="{ value }">
                <slot name="singlelabel" :value="value" />
            </template>

            <template v-slot:tag="{ option, handleTagRemove, disabled }">
                <div class="multiselect-tagX">
                    <slot name="tag" :option="option" :handleTagRemove="handleTagRemove" :disabled="disabled" />
                </div>
            </template>

            <template #clear>
                <div class="flex mr-1">
                    <icon @click="clearSelectedTags" class="self-center cursor-pointer transform hover:scale-110 text-gray-400 h-5 w-5" name="x"></icon>

                    <icon-button @click="storeOption" v-if="withStored && mode !== 'tags' " :iconName="optionSelected ? 'pencil' : 'plus-circle'" :classes="optionSelected ? 'bg-blue-700 hover:bg-blue-600 text-white rounded h-5/6 w-8 p-1 m-1' : 'bg-green-700 hover:bg-green-600 text-white rounded h-5/6 w-8 p-1 m-1'" ></icon-button>
                    <icon-button @click="storeOption" v-else-if="withStored" iconName="plus-circle" classes="bg-green-700 hover:bg-green-600 text-white rounded h-5/6 w-8 p-1 m-1" ></icon-button>
                </div>
            </template>

            <template #caret>
                <div class="flex mr-1">
                    <icon class="self-center cursor-pointer transform hover:scale-110 text-gray-400" h="4" w="4" name="caret"></icon>
                    <icon-button @click="storeOption" v-if="withStored" iconName="plus-circle" classes="bg-green-700 hover:bg-green-600 text-white rounded h-5/6 w-8 p-1 m-1" ></icon-button>
                </div>
            </template>

            <template #nooptions>
                <p v-if="isEmpty(search)"></p>
                <div v-else>
                    <p class="italic text-xs">Aucun résultat pour votre recherche</p>
                    <p class="italic text-xs text-green-600" v-if="withStored">Vous pouvez créer une nouvelle donnée -></p>
                </div>

            </template>

        </Multiselect>
    </div>
    <div v-if="error" class="text-red-600">{{ error }}</div>

</template>

<script>
import Multiselect from '@vueform/multiselect'
import axios from "axios";
import Icon from "@/Shared/Components/Icon";
import IconButton from "@/Shared/Components/IconButton";

export default {
    name: "SelectSearch",
    data() {
        return {
            search: null,
            value: this.modelValue,
            settings: {
                value: this.modelValue,
                mode: this.mode,
                placeholder: this.placeholder,
                label: this.labelDisplayed,
                trackBy:this.labelDisplayed,

                filterResults: true,
                minChars: 1,
                resolveOnLoad: true,
                delay: 0,
                searchable: true,
                valueProp:"id",
                options: async (query) => {
                    return await this.getOptions(query)
                }
            }
        }
    },
    components: {
        Multiselect,
        Icon,
        IconButton
    },
    props: {
        modelValue: undefined,
        mode: {
            type: String,
            default: "single"
        },
        placeholder: {
            type: String,
            default: "Choisissez un élément"
        },
        //Recherche dans la BDD avec cette clé
        searchInApiBy: {
            type: String,
            default: "label"
        },
        labelDisplayed: {
            type: String,
            default: "label"
        },
        apiRoute: {
            type: String,
            default: ""
        },
        loadAllOnLoad: {
            type: Boolean,
            default: false
        },
        withStored: {
            Boolean,
            default: false
        },
        error: String,
    },
    emits: ['update:modelValue', 'createOption', 'editOption', 'storeOption'],
    created() {
        switch (this.mode) {
            case 'tags':
                // Pour les tags, il nous faut un tableau avec que les ID
                if(this.value) {
                    this.value = this.value.map(element => {
                        if(element.hasOwnProperty('id')) {
                            return element.id
                        }else {
                            return element
                        }
                    });
                }
                break;
        }
    },
    methods: {
        async getOptions(query) {

            let where = [];

            if (query) {
                where[this.searchInApiBy] = query
            } else {
                if (!this.isEmpty(this.value)) {
                    switch (this.mode) {
                        case 'tags':
                            where['id'] = []
                            this.value.forEach(element => where['id'].push(element));
                            break;
                        case 'single':
                            where['id'] = this.value
                            break;
                    }

                }else if(this.loadAllOnLoad) {
                }else {
                    return []
                }
            }

            const response = await fetch(
                this.route(this.apiRoute, {
                    params: where,
                }),
                {
                    headers: {
                        'X-Parse-Application-Id': 'XpRShKqJcxlqE5EQKs4bmSkozac44osKifZvLXCL', // This is the fake app's application id
                        'X-Parse-Master-Key': 'Mr2UIBiCImScFbbCLndBv8qPRUKwBAq27plwXVuv', // This is the fake app's readonly master key
                    }
                }
            );

            let data = await response.json(); // Here you have the data that you need

            // console.log(data[0])



            data = data[0].map((item) => {
                // return {id: item.id, label: item.name, options: item}
                // let itemCustom = {id: item.id, label: item.name, options: item}
                let itemCustom = {id: item.id, options: item}
                itemCustom[this.labelDisplayed] = item[this.labelDisplayed]
                return itemCustom
                // return ['id' = item.id, 'label' = item.name, 'options' = item]
            })

            // data = data.results.map((item) => {
            //     return {id: item.objectId, label: item.ProgrammingLanguage, options: item}
            // })

            return data ? data : []
        },
        storeOption() {
            this.$refs.multiselecttest.close()
            this.$emit('storeOption')
        },
        clearSelectedTags() {
            this.value = []
        },
        searchChange(query) {
            this.search = query
        }
    },
    computed: {
        optionSelected() {
            return !this.isEmpty(this.modelValue)
        }
    },
    watch: {
        value(newValue, oldValue) {
            this.$emit('update:modelValue', newValue)
        }
    },
}
</script>


<style>

    .multiselect-option {
        padding: 29px !important;
        /*padding: 35px 29px 35px 29px !important;*/
    }

    .multiselect {
        background-color: white;
        border-radius: 0.25rem;
    }

    .multiselect-input {
        border-radius: 0.25rem;
        min-width: 250px;
    }

    .multiselect-tag {
        color: #3d5e8e !important;
    }

    .multiselect-tags {
        margin-bottom: 5px !important;
    }

    .multiselect-tags span {
        display: inline-block;
        margin-right: 10px;
    }

    .img-is-user {
        width: 35px;
        border-radius: 50%;
        height: 35px;
        margin-right: 8px;
        border: 2px solid #ffffffbf;
    }

    .multiselect-search {
        min-width: 25px;
    }

    /*.multiselect-clear {*/
    /*    right: 32px !important;*/
    /*}*/

</style>


