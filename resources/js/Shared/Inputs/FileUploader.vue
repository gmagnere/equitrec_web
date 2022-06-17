<template>

    <FilePond
        v-if="isInputable"
        name="myfile"
        :server="{
                      url: '/upload',
                      process: {
                        headers: {
                          'X-CSRF-TOKEN': csrf
                        }
                      }
                    }"
        @processfile="onProcessFile"
        @removefile="onRemove"
        :allow-multiple="true"
    />

    <div v-if="withPreview">
        <MediasPreview :isDeleted="isDeleted" :files="files" :isInputable="isInputable"></MediasPreview>
    </div>


</template>

<script>
import MediasPreview from "@/Shared/Components/MediasPreview";
export default {
    name: "FileUploader",
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            filesTmp: []
        }
    },
    props: {
        modelValue: Array,
        withPreview: {
            type: [Boolean, String],
            default: false
        },
        isDeleted: {
            type: [Boolean, String],
            default: false
        },
        files: {
            type: Array,
            default: []
        },
        isInputable: {
            type: Boolean,
            default: true,
        },
    },
    components: {
        MediasPreview,
    },
    methods: {
        onProcessFile(error, file) {
            this.filesTmp.push(file.serverId.split('<')[0])
            this.emitsFiles()
        },
        onRemove(error, file) {
            this.filesTmp = this.filesTmp.filter(function (e) {
                return e !== file.serverId
            })
            axios.post(route('upload.destroy'), {
                idFolder: file.serverId,
            });
            this.emitsFiles()
        },
        emitsFiles() {
            this.$emit('update:modelValue', this.filesTmp)
        }
    },
}
</script>

<style scoped>
    .filepond--credits {
        display: none !important;
    }
</style>
