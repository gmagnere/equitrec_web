<template>
    <!--    <div class="border shadow rounded p-2 mb-2">-->
    <!--        <div class="flex">-->
    <!--            <a :href="'contacts' +  '?params[id]=' + contact.id" target="_blank" class="flex text-blue-500 hover:underline font-bold">-->
    <!--                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify&#45;&#45;mdi" width="32" height="32" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path d="M12 2A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10A10 10 0 0 0 12 2M7.07 18.28c.43-.9 3.05-1.78 4.93-1.78s4.5.88 4.93 1.78A7.893 7.893 0 0 1 12 20c-1.86 0-3.57-.64-4.93-1.72m11.29-1.45c-1.43-1.74-4.9-2.33-6.36-2.33s-4.93.59-6.36 2.33A7.928 7.928 0 0 1 4 12c0-4.41 3.59-8 8-8s8 3.59 8 8c0 1.82-.62 3.5-1.64 4.83M12 6c-1.94 0-3.5 1.56-3.5 3.5S10.06 13 12 13s3.5-1.56 3.5-3.5S13.94 6 12 6m0 5a1.5 1.5 0 0 1-1.5-1.5A1.5 1.5 0 0 1 12 8a1.5 1.5 0 0 1 1.5 1.5A1.5 1.5 0 0 1 12 11z" fill="currentColor"></path></svg>-->
    <!--                <span class="self-center ml-1">{{contact.name}}</span>-->
    <!--            </a>-->
    <!--            <p class="ml-4 self-center">{{ contact.position }}</p>-->
    <!--        </div>-->
    <!--        <div class="flex">-->
    <!--            <a :href="'tel:' + contact.phone" target="_blank" class="text-blue-500 hover:underline">{{ contact.phone }}</a>-->
    <!--            <a :href="'mailto:' + contact.email" target="_blank" class="text-blue-500 hover:underline ml-2"> {{ contact.email }}</a>-->
    <!--        </div>-->
    <!--    </div>-->
    <div class='rounded-md border shadow bg-white mb-3'>

        <div @click="viewRelation" class='items-center px-5 py-3 cursor-pointer hover:bg-gray-100'>
            <div class='flex items-center mx-3'>
                <icon name="contact-outline"></icon>
                <p class='ml-2 text-gray-600 font-bold'>{{contact.name}}</p>
                <p class="ml-4 text-gray-600">{{ contact.position }}</p>
            </div>

            <span v-if="contact.is_important" class="m-1 text-gray-800 text-md rounded-md px-2 font-bold text-sm leading-loose bg-red-300">Personne à contacter</span>
        </div>
        <hr/>
        <div class='px-5 '>
            <div class='my-3 flex flex-wrap -m-1'>
                <a v-if="contact.phone" :href="'tel:' + contact.phone" target="_blank" class="m-1 text-blue-900 text-md bg-blue-200 hover:bg-blue-300 rounded-md px-2 font-bold text-sm leading-loose cursor-pointer">{{ contact.phone }}</a>
                <a v-if="contact.email" :href="'mailto:' + contact.email" target="_blank" class="m-1 text-blue-900 text-md bg-blue-200 hover:bg-blue-300 rounded-md px-2 font-bold text-sm leading-loose cursor-pointer"> {{ contact.email }}</a>
            </div>
        </div>


    </div>
</template>

<script>
import Icon from "@/Shared/Components/Icon";
export default {
    name: "Contact",
    components: {Icon},
    props: {
        contact: {
            type: Object,
            default: []
        },
    },
    methods: {
        viewRelation() {
            if(this.can("contact.red")) {
                let myWindow = window.open(route('contacts', {'params[id]': this.contact.id}), "_blank");
                myWindow.focus();
            }

        },
    },
}
</script>

<style scoped>

</style>
