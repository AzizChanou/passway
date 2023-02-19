<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

</script>

<template>
    <Head title="FAQs" />
    <GuestLayout>
        <div class="grid grid-cols-1 gap-8 mx-auto rounded-lg md:grid-cols-2">
            <div class="flex flex-col justify-between">
                <div class="space-y-2">
                    <h2 class="text-4xl font-bold leading-tight lg:text-5xl">Let's talk!</h2>
                    <div class="text-gray-400">Vivamus in nisl metus? Phasellus.</div>
                </div>
                <img src="assets/svg/doodle.svg" alt="" class="p-6 h-52 md:h-64">
            </div>
            <form novalidate="" class="space-y-6 ng-untouched ng-pristine ng-valid">
                <div>
                    <label for="name" class="text-sm">Full name</label>
                    <input id="name" type="text" placeholder="" class="w-full p-3 rounded">
                </div>
                <div>
                    <label for="email" class="text-sm">Email</label>
                    <input id="email" type="email" class="w-full p-3 rounded">
                </div>
                <div>
                    <label for="message" class="text-sm">Message</label>
                    <textarea id="message" rows="3" class="w-full p-3 rounded"></textarea>
                </div>
                <button type="submit"
                    class="w-full p-3 text-sm font-bold tracking-wide uppercase rounded bg-primary text-white">Send
                    Message</button>
            </form>
        </div>
    </GuestLayout>
</template>