<template>

    <label class="font-medium text-sm text-gray-700 flex justify-between">{{ label }}
        <!--            <badge-button v-if="can('contact.store')" @click="showModal = !showModal" :styleFilled="false">+ Ajouter</badge-button>-->
    </label>
    <select-search v-model="modelValue"
                   mode="tags"
                   searchInApiBy="name"
                   labelDisplayed="name"
                   apiRoute="api.users"
                   :placeholder="placeholder"
                   :loadAllOnLoad="true"
    >

        <template #option="{option}">
            <div>
                <p>{{ option.name }}</p>
                <p class="text-xs italic">{{option.options.position}}</p>
            </div>
        </template>

        <template #tag="{option, handleTagRemove, disabled}">
            <div class="bg-is-user text-white rounded">
                <div class="flex">
                    <!--                    <img class="img-is-user" src="https://randomuser.me/api/portraits/med/women/2.jpg" alt="">-->
                    <p class="self-center">{{ option.name }}</p>
                    <icon  @mousedown.prevent="handleTagRemove(option, $event)"
                           class="self-center cursor-pointer hover:text-red-600" name="x" h="4"></icon>
                </div>
            </div>
        </template>
    </select-search>


</template>

<script>
import SelectSearch from "@/Shared/Inputs/Select/SelectSearch"
import Icon from "@/Shared/Components/Icon";
import BadgeButton from "@/Shared/Components/BadgeButton";
import ModalSimple from "@/Shared/Modal/ModalSimple";
export default {
    name: "UsersSelect",
    data() {
        return {
            showModal: false,
        }
    },
    components: {
        SelectSearch,
        Icon,
        ModalSimple,
        BadgeButton,
    },
    props: {
        modelValue: undefined,
        label: {
            type: String,
            default: ""
        },
        isUpdatable : {
            type: Boolean,
            default: true,
        },
        data: {
            type: [Object,Array],
            default: []
        },
        modelType: {
            type: String,
            default: "true",
        },
        modelId: {
            type: Number,
            default: null,
        },
        placeholder: {
            type: String,
            default: 'Employés'
        }
    },
    emits: ['update:modelValue'],
    watch: {
        modelValue(newValue, oldValue) {
            this.$emit('update:modelValue', newValue)
        }
    },
}
</script>

<style scoped>
.bg-is-user {
    padding: 5px 8px;
    background: #35495e;
    margin: 3px 3px 8px;
}
</style>
