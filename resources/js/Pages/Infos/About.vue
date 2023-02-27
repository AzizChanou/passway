<script setup>
import Member from '@/Components/Member.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

</script>

<template>
    <Head title="A propos" />
    <GuestLayout>
        <section class="py-6 bg-slate-100 text-primary">
            <div class="container flex flex-col items-center justify-center p-4 mx-auto sm:p-10">
                <p class="p-2 text-sm font-medium tracking-wider text-center uppercase">Development team</p>
                <h1 class="text-4xl font-bold leading-none text-center sm:text-5xl">The talented people behind the scenes
                </h1>
                <div class="flex flex-row flex-wrap-reverse justify-center mt-8 text-white">
                    <Member />
                    <Member />
                    <Member />
                    <Member />
                </div>
            </div>
        </section>
    </GuestLayout>
</template>