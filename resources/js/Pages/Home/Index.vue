<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Category from '@/Components/Category.vue'
import { Head } from '@inertiajs/vue3';
import EventCard from '@/Components/EventCard.vue';
import Testimonials from '@/Components/Testimonials.vue';
import Banner from '@/Components/Banner.vue';

const props = defineProps({
    categories: {},
    events: {}
});

</script>

<template>
    <Head title="Accueil" />
    <GuestLayout class="">
        <Category :categories="categories" />
        <Banner />
        <div>
            <h2 class="text-2xl font-medium">
                Evenements
            </h2>
            <div class="w-full grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 py-4 gap-4 place-items-center">
                <EventCard v-for="event in events" :key="event?.id" :event="event" />
            </div>
        </div>
        <div>
            <h2 class="text-2xl font-medium">
                Testimonials
            </h2>
            <Testimonials />
        </div>
    </GuestLayout>
</template>