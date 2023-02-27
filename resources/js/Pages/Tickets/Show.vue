<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Tableau de bord" />

    <AdminLayout>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
            <Link :href="route('pass.create')"
                class="bg-slate-100 rounded flex flex-col justify-center shadow-sm items-center p-4 hover:scale-95 duration-300">
            <i class="fi-sr-calendar text-slate-500 text-8xl"></i>
            <span class="text-2xl font-semibold font-mono uppercase text-primary">Evenements</span>
            </Link>
            <Link :href="route('pass.create')"
                class="bg-slate-100 rounded flex flex-col justify-center shadow-sm items-center p-4 hover:scale-95 duration-300">
            <i class="fi-sr-chart-pie text-slate-500 text-8xl"></i>
            <span class="text-2xl font-semibold font-mono uppercase text-primary">Statistique</span>
            </Link>
            <Link :href="route('pass.create')"
                class="bg-slate-100 rounded flex flex-col justify-center shadow-sm items-center p-4 hover:scale-95 duration-300">
            <i class="fi-sr-user text-slate-500 text-8xl"></i>
            <span class="text-2xl font-semibold font-mono uppercase text-primary">Administrateur</span>
            </Link>
        </div>
    </AdminLayout>
</template>