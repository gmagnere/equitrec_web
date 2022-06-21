<template>
    <app-layout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Compétition
            </h2>
        </template>
        <modal :show=show :closeable=true>
            <button @click="this.show = false" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                X
            </button>
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" @submit.prevent="submit">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name" >
                        Nom de la compétition
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                            leading-tight focus:outline-none focus:shadow-outline" id="name" type="text"
                           v-model="form.name">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="place">
                        Lieu de la compétition
                    </label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                            leading-tight focus:outline-none focus:shadow-outline" id="email" type="text"
                              v-model="form.place">
                            </textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="role">
                        Epreuve
                    </label>
                </div>
                <select v-model="form.trial" id="roles" class=" mb-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-white dark:border-gray-600 dark:placeholder-gray-400 text-gray-700 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Selectionner une epreuve</option>
                    <option :value="trial" v-for="(trial, index) in trials" :key="trials.id">
                        {{trial.libelleTrial}}
                    </option>
                </select>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="dateStart">
                        Date de début de la compétition
                    </label>
                    <input v-model="form.dateStart" type="date">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="dateEnd">
                        Date de fin de la compétition
                    </label>
                    <input v-model="form.dateEnd" type="date">
                </div>
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
                                         Créer une compétition
                                    </button>
                                    <table class="min-w-full divide-y divide-gray-200 table-fixed">
                                        <thead class="bg-indigo-500">
                                        <tr>
                                            <th scope="col" class="py-3 px-6 w-3/12 text-xs font-semibold tracking-wider text-left text-white uppercase">
                                                Nom de la compétition
                                            </th>
                                            <th scope="col" class="py-3 px-6 w-3/12 text-xs font-semibold tracking-wider text-left text-white uppercase">
                                                Lieu de la compétition
                                            </th>
                                            <th scope="col" class="py-3 px-6 w-3/12 text-xs font-semibold tracking-wider text-left text-white uppercase">
                                                Date de début
                                            </th>
                                            <th scope="col" class="py-3 px-6 w-3/12 text-xs font-semibold tracking-wider text-left text-white uppercase">
                                                Date de fin
                                            </th>
                                            <th scope="col" class="py-3 px-6 w-3/12 text-xs font-semibold tracking-wider text-left text-white uppercase">
                                                Action
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        <tr v-for="(championship, index) in championships.data" :key="championship.id">
                                            <td class="py-4 px-6 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-sm font-semibold text-gray-900">
                                                            {{ championship.name }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap">
                                                {{ championship.place }}
                                            </td>
                                            <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap">
                                                {{ championship.dateStart }}
                                            </td>
                                            <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap">
                                                {{ championship.dateEnd }}
                                            </td>
                                            <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap">
                                                <button @click="deleteChampionship(championship)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
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
import Modal from "../../../../vendor/laravel/jetstream/stubs/inertia/resources/js/Jetstream/Modal";
import Dropdown from "../../../../vendor/laravel/jetstream/stubs/inertia/resources/js/Jetstream/Dropdown";

export default {
    components: {
        Dropdown,
        Modal,
        AppLayout,
    },
    props: {
        championships: Object,
        trials: {
            type: Array,
            default: () => []
        },
    },
    data() {
        return {
            show: false,
            form: this.$inertia.form({
                name: null,
                place: null,
                dateStart: null,
                dateEnd: null,
                trial: null,
                championship: null,
            }),
        };
    },
    methods: {
        submit(){
            this.form.post(this.route('championship.add'), {
                preserveScroll: true,
                preserveState: false,
                onSuccess: () => {
                    this.close()
                }
            })
        },

        deleteChampionship(championship){
            this.form.championship = championship;
            this.form.post(this.route('championship.delete'), {
                preserveScroll: true,
                preserveState: false,
            })
        },
    },
};
</script>

