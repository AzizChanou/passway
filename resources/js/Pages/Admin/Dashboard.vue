<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Tableau de bord" />

    <AdminLayout>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <Link
                :href="route('profile.index')"
                class="bg-slate-100 rounded flex flex-col justify-center shadow-sm items-center p-4 hover:scale-95 duration-300"
            >
                <i class="fi-sr-user text-slate-500 text-8xl"></i>
                <span
                    class="text-xl font-semibold font-mono uppercase text-primary"
                    >Administrateur</span
                >
            </Link>
            <Link
                :href="route('event.index')"
                class="bg-slate-100 rounded flex flex-col justify-center shadow-sm items-center p-4 hover:scale-95 duration-300"
            >
                <i class="fi-sr-calendar text-slate-500 text-8xl"></i>
                <span
                    class="text-xl font-semibold font-mono uppercase text-primary"
                    >Evenements</span
                >
            </Link>
            <!-- <Link
                :href="route('event.create')"
                class="bg-slate-100 rounded flex flex-col justify-center shadow-sm items-center p-4 hover:scale-95 duration-300"
            >
                <i class="fi-sr-money text-slate-500 text-8xl"></i>
                <span
                    class="text-xl font-semibold font-mono uppercase text-primary"
                    >Paiement</span
                >
            </Link> -->
            <Link
                :href="route('qrcode.index')"
                class="bg-slate-100 rounded flex flex-col justify-center shadow-sm items-center p-4 hover:scale-95 duration-300"
            >
                <i class="fi-sr-camera text-slate-500 text-8xl"></i>
                <span
                    class="text-xl font-semibold font-mono uppercase text-primary"
                    >QRCode</span
                >
            </Link>
        </div>
    </AdminLayout>
</template>
