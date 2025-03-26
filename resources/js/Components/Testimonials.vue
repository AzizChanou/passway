<script setup>
import Testimonial from "@/Components/Testimonial.vue";
import { Swiper, SwiperSlide } from "swiper/vue";
import { Autoplay, Pagination } from "swiper";
import testimonials from "@/db/testimonials.js";
</script>

<template>
    <div>
        <swiper
            :modules="[Autoplay, Pagination]"
            :free-mode="true"
            :autoplay="true"
            :pagination="{
                clickable: true,
            }"
            :loop="true"
            :speed="500"
        >
            <swiper-slide v-for="testimonial in testimonials">
                <Testimonial :testimonial="testimonial" />
            </swiper-slide>
        </swiper>
    </div>
</template>
