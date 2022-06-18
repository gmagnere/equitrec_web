<template>
    <app-layout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Contacts
            </h2>
        </template>
        <modal :show=show :closeable=true>
            <button @click="this.show = false" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                X
            </button>
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" @submit.prevent="submit">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name" >
                        Nom du cavalier
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                            leading-tight focus:outline-none focus:shadow-outline" id="name" type="text"
                           v-model="form.name">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="surname">
                        Prénom du cavalier
                    </label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                            leading-tight focus:outline-none focus:shadow-outline" id="surname" type="text"
                              v-model="form.surname">
                            </textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="bib_number">
                        Numéro de dossard
                    </label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                            leading-tight focus:outline-none focus:shadow-outline" id="bib_number" type="text"
                              v-model="form.bib_number">
                            </textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="championship">
                        Compétition auquelle le cavalier est inscrit
                    </label>
                </div>
                <select v-model="form.championship" id="championship" class=" mb-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-white dark:border-gray-600 dark:placeholder-gray-400 text-gray-700 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Selectionner une compétition</option>
                    <option :value="championship" v-for="(championship, index) in championships" :key="championships.id">
                        {{championship.name}}
                    </option>
                </select>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded
                        focus:outline-none focus:shadow-outline" type="submit">
                    Valider
                </button>
            </form>
        </modal>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-md sm:rounded-lg">
                    <div class="flex flex-col">
                        <div class="overflow-x-auto -my-2 sm:-mx-6 lg:-mx-8">
                            <div class="inline-block py-2 min-w-full align-middle sm:px-6 lg:px-8">
                                <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                                    <button @click="this.show = true" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded flex justify-end mb-2">
                                        Ajouter un cavalier
                                    </button>
                                    <table class="min-w-full divide-y divide-gray-200 table-fixed">
                                        <thead class="bg-indigo-500">
                                        <tr>
                                            <th scope="col" class="py-3 px-6 w-3/12 text-xs font-semibold tracking-wider text-left text-white uppercase">
                                                Nom
                                            </th>
                                            <th scope="col" class="py-3 px-6 w-3/12 text-xs font-semibold tracking-wider text-left text-white uppercase">
                                                Prenom
                                            </th>
                                            <th scope="col" class="py-3 px-6 w-3/12 text-xs font-semibold tracking-wider text-left text-white uppercase">
                                                Numéro de dossard
                                            </th>
                                            <th scope="col" class="py-3 px-6 w-3/12 text-xs font-semibold tracking-wider text-left text-white uppercase">
                                                Compétition en cours
                                            </th>
                                            <th scope="col" class="py-3 px-6 w-3/12 text-xs font-semibold tracking-wider text-left text-white uppercase">
                                                Action
                                            </th>
                                        </tr>
                                        </thead>
                                        <dropdown></dropdown>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        <tr v-for="(rider, index) in riders.data" :key="rider.id">
                                            <td class="py-4 px-6 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-sm font-semibold text-gray-900">
                                                            {{ rider.name }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">
                                                    {{ rider.surname }}
                                                </div>
                                            </td>
                                            <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap">
                                                {{ rider.bib_number }}
                                            </td>
                                            <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap">
                                                {{ rider.champion_ship_from_rider.name }}
                                            </td>
                                            <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap">
                                                <button @click="deleteRider(rider)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                                    Supprimer
                                                </button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import { pickBy, throttle } from 'lodash';
import Modal from "../../../../vendor/laravel/jetstream/stubs/inertia/resources/js/Jetstream/Modal";
import Dropdown from "../../../../vendor/laravel/jetstream/stubs/inertia/resources/js/Jetstream/Dropdown";

export default {
    components: {
        Dropdown,
        Modal,
        AppLayout,
    },
    props: {
        riders: Object,
        filters: Object,
        championships:{
            type: Array,
            default: () => []
        },
    },
    data() {
        return {
            params: {
                search: this.filters.search,
                field: this.filters.field,
                direction: this.filters.direction,
            },
            show: false,
            form: this.$inertia.form({
                name: null,
                surname: null,
                bib_number: null,
                championship: null,
                rider: null,
            }),
        };
    },
    methods: {
        sort(field) {
            this.params.field = field;
            this.params.direction = this.params.direction === 'asc' ? 'desc' : 'asc';
        },
        submit(){
            this.form.post(this.route('rider.add'), {
                preserveScroll: true,
                preserveState: false,
                onSuccess: () => {
                    this.close()
                }
            })
        },

        deleteRider(rider){
            this.form.rider = rider;
            this.form.post(this.route('rider.delete'), {
                preserveScroll: true,
                preserveState: false,
            })
        },
    },
    watch: {
        params: {
            handler: throttle(function () {
                let params = pickBy(this.params);

                this.$inertia.get(this.route('contacts'), params, { replace: true, preserveState: true });
            }, 150),
            deep: true,
        },
    },
};
</script>
