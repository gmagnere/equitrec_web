<template>
    <app-layout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Générer un qr code
                <br>
                <button @click="generate" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    Générer
                </button>
            </h2>
        </template>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
export default {
    name: "Index",
    components: {
        AppLayout
    },

    data() {
        return {
            form: this.$inertia.form({
                judges: this.judges,
                championships: this.championships,
                rider: this.rider,
                trials: this.trials,
                $obstacles: this.obstacles,
            }),
        }
    },

    props: {
        judges: Object,
        championships: Object,
        rider: Object,
        trials: Object,
        obstacles: Object,
    },

    methods: {
        generate() {
            this.form.post(this.route('qrcode.generate'), {
                preserveScroll: true,
                preserveState: false,
                onSuccess: () => {
                    this.close()
                }
            })
        }
    },
}
</script>

<style scoped>

</style>
