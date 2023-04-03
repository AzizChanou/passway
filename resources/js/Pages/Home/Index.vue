<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Category from '@/Components/Category.vue'
import { Head, router } from '@inertiajs/vue3';
import EventCard from '@/Components/EventCard.vue';
import Testimonials from '@/Components/Testimonials.vue';
import Banner from '@/Components/Banner.vue';
import useThrottle from '@/helpers/useThrottle';
import { ref } from 'vue';

const recherche = ref(null);

const searchEvents = useThrottle(() => {
    recherche.value == '' ? router.get(route('home')) : router.get(route('search'), { q: recherche.value }, { preserveState: true });
}, 700)

const props = defineProps({
    categories: {},
    events: {}
});
</script>

<template>
    <Head title="Accueil" />
    <GuestLayout class="">
        <Category :categories="categories" />
        <Banner :events="events" />
        <div>
            <h2 class="text-2xl font-medium">
                Evenements
            </h2>
            <div class="w-full ">
                <Mazinput @keydown="searchEvents" id="search" type="text" label="Recherche" v-model="recherche" />
            </div>
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