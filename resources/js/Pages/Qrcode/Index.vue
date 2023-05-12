<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head } from "@inertiajs/vue3";
import QRCodeVue3 from "qrcode-vue3";

const props = defineProps({
    tickets: {},
    client: {},
});
</script>

<template>
    <Head title="Ticket(s)" />
    <GuestLayout>
        <div class="h-full">
            <h1 class="text-2xl px-6 font-bold font-sans text-center">
                QR Code
            </h1>
            <p class="">
                Merci
                <span class="font-medium text-primary text-lg">{{
                    client?.name
                }}</span>
                pour l'achat, ci-joint vos tickets
            </p>
            <div
                class="space-y-2 flex flex-col p-2 placeitemcen sm:grid grid-cols-3 sm:space-y-0 sm:gap-2"
            >
                <QRCodeVue3
                    :dotsOptions="{
                        type: 'square',
                        color: '#0f213a',
                    }"
                    image="/assets/img/logo_dark.png"
                    :cornersSquareOptions="null"
                    type="image/png"
                    color="#0f213a"
                    :width="300"
                    v-for="ticket in tickets"
                    :key="ticket?.id"
                    :value="ticket?.code"
                />
            </div>
        </div>
    </GuestLayout>
</template>
