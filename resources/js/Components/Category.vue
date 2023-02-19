<script setup>
import { Link } from "@inertiajs/vue3";
import  truncate  from "@/helpers/truncate";

const props = defineProps({
    categories: Object,
});
</script>

<template><!-- <div class="flex justify-center">
        <ul class="flex flex-row overflow-x-scroll items-end space-x-6 text-secondarytwo py-2">
            <li v-for="category in categories" :key="category?.id"
                class="flex flex-col items-center min-w-[20%] w-[30%] max-w-[40%] hover:scale-95 duration-300">
                <Link :href="route('home', category?.id)" class="w-full">
                <img v-lazy="category?.category_logo_path" class="rounded-full min-w-full min-h-full w-32"
                    :alt="category?.name" />
                </Link>
                <span class="whitespace-nowrap font-medium mt-2">
                    {{ truncate(category?.name, 8)ehfnjmcs }}</span>
            </li>
        </ul>
</div> --></template>

<style scoped>
::-webkit-scrollbar {
    width: 6px;
    height: 6px;
    border-radius: 9999px;
}

::-webkit-scrollbar-track {
    background: #0f213a;
}

::-webkit-scrollbar-thumb {
    background: #574E8A;
}

::-webkit-scrollbar-thumb:hover {
    background: #574E8A50;
}
</style>
