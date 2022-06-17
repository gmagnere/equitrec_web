<template>

    <label class="font-medium text-sm text-gray-700">{{ label }}</label>
    <select-search v-model="modelValue"
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

        <template #singlelabel="{value}">
            <div class="multiselect-single-label">
<!--                <img class="img-is-user" src="https://randomuser.me/api/portraits/med/women/2.jpg" alt=""> -->
                {{ value.description }}
            </div>
        </template>

    </select-search>

</template>

<script>
import SelectSearch from "@/Shared/Inputs/Select/SelectSearch"
export default {
    name: "UserSelect",
    data() {
        return {
            value: null
        }
    },
    components: {
        SelectSearch,
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
