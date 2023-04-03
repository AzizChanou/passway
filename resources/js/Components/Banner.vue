<script setup>
import { Swiper, SwiperSlide } from "swiper/vue";
import { Autoplay, Pagination } from "swiper";
import { Link } from "@inertiajs/vue3";
import truncate from "@/helpers/truncate";
import { ref } from "vue";

const props = defineProps({
    events: {}
})

const upcomingEvents = ref(props.events.sort((prec, next) => next.created_at - prec.created_at))
upcomingEvents.value = upcomingEvents.value.slice(0, 3)
</script>

<template>
    <div>
        <swiper :modules="[Autoplay, Pagination]" :free-mode="true" :autoplay="true" :pagination="{
            clickable: true,
        }" :loop="true" :speed="1000">
            <swiper-slide v-for="event in upcomingEvents" :key="event.id">
                <div class="bg-primary w-full rounded text-gray-50">
                    <div class="container grid grid-cols-12 mx-auto w-full">
                        <div class="bg-no-repeat bg-cover bg-gray-300 col-span-full lg:col-span-4"
                            :style="`background-image: url('${event?.picture_path}'); background-position: center center; background-blend-mode: multiply; background-size: cover;`">
                        </div>
                        <div class="flex flex-col p-6 col-span-full row-span-full lg:col-span-8 lg:p-10">
                            <div class="flex justify-start">
                                <span class="px-2 py-1 text-xs rounded-full bg-violet-400 text-gray-900">{{
                                    event?.event_category?.name }}</span>
                            </div>
                            <h1 class="text-3xl font-semibold">{{ event?.title }}</h1>
                            <p class="flex-1 pt-2 truncate">{{ truncate(event?.description, 200) }}</p>
                            <Link :href="route('event.show', event?.id)" rel="noopener noreferrer" href="#"
                                class="inline-flex items-center pt-2 pb-6 space-x-2 text-sm text-violet-400">
                            <span>Lire plus</span>
                            <i class="fi-sr-arrow-right"></i>
                            </Link>
                            <div class="flex items-center justify-between pt-2">
                                <div class="flex space-x-2">
                                    <img :src="event.organizer.picture_path" :alt="event.organizer.name"
                                        class="w-8 h-8 rounded-full">
                                    <span class="self-center text-sm">{{ event?.organizer?.name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </swiper-slide>
        </swiper>
    </div>
</template>