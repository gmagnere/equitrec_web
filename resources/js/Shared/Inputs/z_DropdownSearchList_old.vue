<template>
    <div class="dropdown">
        <div v-if="Object.keys(selectedItem).length === 0 &&  isUpdatable">
            <input @click="isInput = true" ref="dropdowninput" v-model.trim="inputValue" class="dropdown-input"
                   type="text" :placeholder="placeholder"/>

                <button v-if="!isInput" @click="resetSelection" class="absolute top-3 right-1">
                    <icon name="chevron-down"></icon>
                </button>
                <button v-if="isInput" @click="emptySelection" class="ml-3 absolute top-3 right-1">
                    <icon name="chevron-up"></icon>
                </button>

        </div>
        <div v-else @click="resetSelection" class="flex" :class="isUpdatable ? 'dropdown-selected' : 'font-bold'">
            <img v-if="selectedItem.img" :src="selectedItem.img" class="dropdown-item-img"/>
            <span class="mr-5">{{ selectedItem.label }}</span>
            <button v-if="isUpdatable" @click="emptySelection" class="absolute top-3 right-1 hover:text-red-800">
                <icon name="x"></icon>
            </button>
        </div>
        <!--    Quand ouvert -->
        <div v-show="isInput && apiLoaded" class="dropdown-list z-30">
            <div @click="selectItem(item)" v-show="itemVisible(item)" v-for="item in itemList" :key="item.label"
                 class="dropdown-item">
                <img :src="item.img" class="dropdown-item-img"/>
                {{ item.label }}
            </div>
            <div v-if="itemList.length === 0 && apiLoaded === true"
                 class="dropdown-item">
                Aucune données disponible en base...
            </div>
            <div v-if="withCreated" @click="addItem" class="dropdown-item">
                <icon class="mr-2" name="plus-circle"></icon>
                Ajouter {{inputValue}}
            </div>
        </div>
    </div>

    <modal-crud v-if="withCreated" :schemas="schema" :showModal="showModal" :inputValue="inputValue" :baseData="clickedItem" @reload="reload" @close="closeModal"></modal-crud>

</template>

<script>
import axios from 'axios'
import Icon from "@/Shared/Components/Icon"
import ModalCrud from "@/Shared/Components/ModalCrud";

export default {
    data() {
        return {
            selectedItem: {},
            inputValue: '',
            isInput: false,
            itemList: [],
            apiLoaded: false,
            showModal: false,
            clickedItem: {}
        }
    },
    mounted() {
        this.getList()

    },
    props: {
        placeholder: String,
        apiUrl: String,
        item_id: {
            type: [String, Number]
        },
        isUpdatable: {
            type: Boolean,
            default: true
        },
        withCreated: {
            type: Boolean,
            default: false
        },
        schema: Object,
    },
    emits: ['on-item-reset', 'on-item-selected', 'itemDetail'],
    components: {
        Icon,
        ModalCrud
    },
    methods: {
        resetSelection() {
            if(this.isUpdatable) {
                this.isInput = true;
                this.selectedItem = {}
                this.$nextTick(() => this.$refs.dropdowninput.focus())
                this.$emit('on-item-reset')
            }

        },
        emptySelection() {
            this.isInput = false;
            this.selectedItem = {}
            this.inputValue = ''
            this.$emit('on-item-selected', null)
        },
        selectItem(theItem) {
            this.isInput = false;
            this.selectedItem = theItem
            this.inputValue = ''
            this.$emit('on-item-selected', theItem.id)
            this.$emit('itemDetail', theItem)
        },
        itemVisible(item) {
            let currentName = item.label.toLowerCase()
            let currentInput = this.inputValue.toLowerCase()
            return currentName.includes(currentInput)
        },
        getList() {
            axios.get(this.apiUrl).then(response => {
                this.itemList = response.data[0]
                this.apiLoaded = true
                //Charge l'objet avec ID, si fournit
                if (this.item_id) {
                    this.selectedItem = this.itemList.find(x => x.id === this.item_id)
                }
            })
        },
        addItem() {
            this.clickedItem = {
                id: null,
                name : this.inputValue
            }
            this.showModal = true
        },
        reload() {
            this.getList();
            this.showModal = false;
            this.clickedItem = {}
        },
        closeModal() {
            this.showModal = false;
            this.clickedItem = {}
        },
    }
}
</script>

<style>
.dropdown {
    position: relative;
    width: 100%;
    max-width: 400px;
}

.dropdown-input, .dropdown-selected {
    width: 100%;
    padding: 10px 16px;
    border: 1px solid transparent;
    background: #edf2f7;
    line-height: 1.5em;
    outline: none;
    border-radius: 8px;
}

.dropdown-input:focus, .dropdown-selected:hover {
    background: #fff;
    border-color: #e2e8f0;
}

.dropdown-input::placeholder {
    opacity: 0.7;
}

.dropdown-selected {
    font-weight: bold;
    cursor: pointer;
}

.dropdown-list {
    position: absolute;
    width: 100%;
    min-width: 500px;
    max-height: 200px;
    margin-top: 4px;
    overflow-y: auto;
    background: #ffffff;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    border-radius: 8px;
}

.dropdown-item {
    display: flex;
    width: 100%;
    padding: 11px 16px;
    cursor: pointer;
}

.dropdown-item:hover {
    background: #edf2f7;
}

.dropdown-item-img {
    max-width: 24px;
    max-height: 18px;
    margin: auto 12px auto 0px;
}
</style>
