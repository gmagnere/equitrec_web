<template>

    <div class="picturesBox flex items-center">
        <div v-if="!fileLoaded" class="animate-pulse animate-bounce text-gray-400">
            <icon name="images"></icon>
        </div>
        <div v-else>
            <a v-if="type === 'image'" class="rounded " target="_blank"
               :href="file">
                <img class="rounded picture"
                     :src="file"
                     alt="photos">

            </a>
<!--            <a v-else class="rounded inline-flex w-8/12 sm:w-6/12 pr-2" target="_blank"-->
            <a v-else class="" target="_blank"
               :href="file">
                <div
                    class="cursor-pointer flex justify-center items-center m-1 font-medium py-1 px-2 bg-white rounded text-blue-700 hover:text-blue-900 :hover:bg-blue-500 bg-blue-100 border border-blue-300">
                            <span>
                                {{ filename }}
                            </span>
                </div>
            </a>
        </div>
    </div>

</template>

<script>
import Icon from "@/Shared/Components/Icon";
export default {
    name: "Media",
    data() {
        return {
            fileLoaded: false,
            file: null
        }
    },
    components: {
        Icon,
    },
    props: {
        id: [String, Number],
        filename: [String, Number],
        type: String
    },
    mounted() {
        this.loadFile()
    },
    methods: {
        loadFile() {
            let urlApplication = document.location.origin

            axios.get(route('upload.displayFile', [this.id, this.filename])).then(response => {
                this.fileLoaded = true
                this.file = urlApplication + "/files/" + this.id + "/" + this.filename
                // this.file = route('upload.displayFile', ['93' ,'67215307.png'])
            })
        }
    },
    watch: {
        filename(newValue, oldValue) {
            this.loadFile()
        }
    },
}
</script>

<style scoped>

.picturesBox {
    height: 5rem;
}

.picture {
    max-width: 5rem;
    max-height: 5rem;
}
.removeIcon{
    top: -11px;
    right: -3px;
}
</style>
