<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <ul
        class="w-full fixed -bottom-1 flex border-y-2 h-14 md:hidden p-4 items-center flex-row bg-primary shadow text-white justify-around text-xl">
       <!--  <li>
            <Link :href="route('home')" :class="{ 'text-blue-500': $page.url === '/' }"><i class="fi-sr-home"></i>
            </Link>
        </li> -->
        <li>
            <Link :href="route('qrcode.index')" :class="{ 'text-blue-500': $page.url === '/qrcode' }"><i
                class="fi-sr-camera"></i></Link>
        </li>
        <li>
            <Link :href="route('profile.index')" :class="{ 'text-blue-500': $page.url === '/profile' }"><i
                class="fi-sr-user"></i></Link>
        </li>
    </ul>
</template>
