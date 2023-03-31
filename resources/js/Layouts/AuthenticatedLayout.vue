<script setup>
import Logo from '@/Components/Logo.vue';
import Toast from '@/Components/Toast.vue';
import { Link } from '@inertiajs/vue3';


</script>

<template>
    <div class="bg-dots-lighter min-h-screen mx-auto bg-primary flex items-center justify-center">
        <div class="w-full flex flex-col items-center space-y-4">
            <Toast />
            <Link :href="route('home')">
            <Logo color="light" class="h-16 p-2" />
            </Link>
            <div class="w-10/12 lg:w-1/3">
                <slot />
            </div>
        </div>
    </div>
</template>

<style>
.bg-dots-lighter {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
}
</style>