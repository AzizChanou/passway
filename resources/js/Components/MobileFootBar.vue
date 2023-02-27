<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <ul
        class="w-full sticky -bottom-1 flex border-y-2 h-14 md:hidden p-4 items-center flex-row bg-primary shadow text-white justify-around text-xl">
        <li>
            <Link :href="route('home')" :class="{ 'text-blue-500': $page.url === '/' }"><i class="fi-sr-home"></i>
            </Link>
        </li>
        <li>
            <Link :href="route('home')" :class="{ 'text-blue-500': $page.url === '/search' }"><i
                class="fi-sr-camera"></i></Link>
        </li>
        <li>
            <Link :href="route('home')" :class="{ 'text-blue-500': $page.url === '/order' }"><i
                class="fi-sr-document"></i></Link>
        </li>
        <li>
            <Link :href="route('home')" :class="{ 'text-blue-500': $page.url === '/user' }"><i
                class="fi-sr-user"></i></Link>
        </li>
    </ul>
</template>
