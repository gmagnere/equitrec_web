<template>

    <div :class="classBox" class="flex flex-wrap md:flex-row flex-col">

        <template v-for="file in files">

            <div v-if="isPicture(file.file_name) && file.id > 0" class="relative pr-2 mb-2">
                <icon v-if="isDeleted && (isInputable === true)" @click="removeMedia(file)"
                      class="cursor-pointer absolute removeIcon hover:text-red-600" name="x"></icon>
<!--                <a class="rounded " target="_blank"-->
<!--                   :href="route('upload.displayFile', [file.id ,file.file_name])">-->
<!--                    <img class="rounded picture"-->
<!--                         :src="route('upload.displayFile', [file.id ,file.file_name])"-->
<!--                         alt="photos">-->
<!--                   -->
<!--                </a>-->
                <media :id="file.id" :filename="file.file_name" type="image"></media>
            </div>

            <div v-else class="relative">
                <div v-if="file.id > 0">
                    <icon v-if="isDeleted && (isInputable === true)" @click="removeMedia(file)"
                          class="cursor-pointer absolute top-2 right-1 hover:text-red-600" name="x"></icon>
<!--                    <a class="rounded inline-flex w-8/12 sm:w-6/12 pr-2" target="_blank"-->
<!--                       :href="route('upload.displayFile', [file.id ,file.file_name])">-->
<!--                        <div-->
<!--                            class="cursor-pointer flex justify-center items-center m-1 font-medium py-1 px-2 bg-white rounded text-blue-700 hover:text-blue-900 :hover:bg-blue-500 bg-blue-100 border border-blue-300">-->
<!--                            <span>-->
<!--                                {{file.file_name}}-->
<!--                            </span>-->
<!--                        </div>-->
<!--                    </a>-->
                    <media :id="file.id" :filename="file.file_name" type="file"></media>
                </div>
            </div>
        </template>
    </div>

</template>

<script>
import Icon from "@/Shared/Components/Icon"
import Media from "@/Shared/Components/Media"


export default {
    name: "MediasPreview",
    props: {
        files: Array,
        isDeleted: {
            type: [Boolean, String],
            default: false
        },
        isInputable: {
            type: [Boolean, String],
            default: true,
        },
        classBox: {
            type: String,
            default: ""
        }
    },
    components: {
        Icon,
        Media
    },
    created() {
        // this.files.forEach(element => console.log(element));
    },
    methods: {
        isPicture(filename) {
            return (/\.(gif|jpg|jpeg|tiff|png|svg)$/i).test(filename)
        },
        removeMedia(media) {
            if (window.confirm("Êtes-vous sur de vouloir supprimer ce fichier ?")) {
                this.$inertia.post(route('upload.destroyMediaStored'), media, {
                    preserveScroll: true,
                    onSuccess: () => {
                        media.id = "0"
                    }
                })
            }
        },
        loadFile(filename) {
            console.log('load')
        }
        // rtnBaseUrl() {
        //     let baseUrl = ""
        //
        //     switch (window.location.hostname) {
        //         case 'localhost':
        //             baseUrl = "http://" + window.location.hostname + ":8000/"
        //             break;
        //         default:
        //             baseUrl = "https://" + window.location.hostname + "/"
        //     }
        //     return baseUrl
        //
        // }
    },
    // watch: {
    //     files(newValue, oldValue) {
    //     }
    // },
}
</script>

<style scoped>
    .picture {
        max-width: 5rem;
        max-height: 5rem;
    }
    .removeIcon{
        top: -11px;
        right: -3px;
    }
</style>
