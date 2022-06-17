<template>
    <div v-if="links.length > 1">
        <div class="flex flex-wrap -mb-1">
            <template v-for="(link, key) in links">
                <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"
                     v-html="link.label"/>
                <button @click="hrefLink(link.url)" v-else
                        class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500"
                        :class="{ 'bg-white': link.active }" v-html="link.label"/>
            </template>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        links: {
            default: []
        },
        only: {
            type: String,
            default: ""
        },
    },
    methods: {
        hrefLink(url) {

            let currentUrl = url.split('?')[0]
            let pageN = url.split('?')[1].split('=')[1]

            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('page', pageN);

            this.$inertia.get(currentUrl, urlParams, {
                preserveState: true,
                preserveScroll: true,
                only: [this.only]
            })
        }

    },
}
</script>
