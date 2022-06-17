<template>

    <p>Années</p>
    <span @click="selectYear(fiscalYear)" class="mr-3 font-medium py-1 px-2 rounded  align-middle cursor-pointer shadow hover:bg-blue-100"
          v-for="fiscalYear in fiscalYears"
          :class="fiscalYear.start === currentYear.split('/')[0] ? 'bg-red-600 font-bold text-white border-b-2 border-white' : 'bg-blue-50 text-blue-500'"
    >
            {{ fiscalYear.label }}
    </span>

</template>

<script>
export default {
    name: "FiscalYears",
    data() {
        return {
            selectedDate: this.currentYear
        }
    },
    props: {
        fiscalYears: {
            type: Array,
            default: []
        },
        currentYear: String,
        modelValue: undefined,
    },
    methods: {
        selectYear(fiscalYear) {
            this.selectedDate = fiscalYear.start + "/" + fiscalYear.end
            this.$emit('update:modelValue', this.selectedDate)
        }
    },
}
</script>

<style scoped>

</style>
