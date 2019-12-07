<script setup>
import { Head } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";

defineProps({
    status: Number,
});
</script>

<template>
    <Head title="Erreur serveur" />
    <GuestLayout>
        <div v-if="status === 500" class="w-full h-full">
            <div class="h-full p-6 flex flex-col place-content-center">
                <div class="flex justify-center items-center">
                    <img src="../../../../public/assets/svg/err.svg" alt="" class="" />
                </div>
                <div class="text-4xl text-center">
                    <h1>Probleme de serveur.</h1>
                    <p>Veuillez reesaiyer</p>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
