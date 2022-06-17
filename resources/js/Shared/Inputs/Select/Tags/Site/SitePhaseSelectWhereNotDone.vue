<template>

    <label class="font-medium text-sm text-gray-700">{{ label }}</label>
    <select-search v-model="modelValue"
                   mode="tags"
                   searchInApiBy="description"
                   labelDisplayed="description"
                   apiRoute="api.sitesWhereNotDone"
                   placeholder="Phases non cloturé"
    >
        <template #option="{option}">
            <div class="w-full">
                <p class="flex items-center justify-between">
                    {{ option.description }}
                    <span class="text-xs italic">Phase {{option.options.phase}}</span>
                </p>
                <p class="flex items-center justify-end">
                    <span class="text-xs italic">{{option.options.status.label}}</span>

                </p>
            </div>
        </template>

        <template #tag="{option, handleTagRemove, disabled}">
            <div class="rounded py-1 px-2 border text-blue-700 bg-blue-100 border-blue-300">
                <div class="flex">
                    <p class="self-center">{{ option.description }}</p>
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

export default {
    name: "UserSelect",
    data() {
        return {
            value: null
        }
    },
    components: {
        SelectSearch,
        Icon
    },
    props: {
        modelValue: undefined,
        label: {
            type: String,
            default: ""
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

</style>
