<template>

    <div :class="colorResult" class="rounded border border-gray-600 bg-gray-100">
            <span v-if="forceScanValue" class="flex justify-end pr-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                {{ forceScanValue }}
            </span>

        <div v-on:dblclick="isManual = !isManual" class="flex justify-center">
            <StreamBarcodeReader
                class="md:w-1/2 w-full"
                @decode="onDecode"
                @loaded="onLoaded"
            ></StreamBarcodeReader>
        </div>
        <p v-on:dblclick="isManual = !isManual" v-if="!isManual" class="font-semibold text-xl text-center text-gray-800 leading-tight ">{{ result }}</p>
        <jet-input v-else v-model="result" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></jet-input>
    </div>




</template>

<script>
import { StreamBarcodeReader } from "vue-barcode-reader";
import JetInput from '@/Jetstream/Input';

export default {
    name: "BarcodeReader",
    data() {
        return {
            result: " - ",
            colorResult: "",
            isManual: false,
        }
    },
    components: {
        StreamBarcodeReader,
        JetInput,
    },
    props: {
        forceScanValue: {
            type: String,
            default: ""
        },
    },
    methods: {
        onDecode (result) {
            this.result = result
            this.$emit('decode', result)
        },
        onLoaded (result) {
        },
    },
    watch: {
        result(newValue) {
            if (this.forceScanValue !== "") {
                if(newValue !== this.forceScanValue) {
                   this.colorResult =  'rounded border border-red-600 bg-red-100 '
                }else {
                    this. colorResult = 'rounded border border-green-600 bg-green-100 '

                }
            }
            this.$emit('decode', newValue)
        }
    },

}
</script>

<style scoped>

</style>
