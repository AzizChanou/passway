<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Category from '@/Components/Category.vue'
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    event: {}
})

console.log(props.event);

</script>

<template>
    <Head title="Accueil" />
    <GuestLayout>
    
    </GuestLayout>
</template>