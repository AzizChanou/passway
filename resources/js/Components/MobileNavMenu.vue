<script setup>
import { Link } from "@inertiajs/vue3";

const currentYear = new Date().getFullYear();
</script>

<template>
    <div id="menu"
        class="transition-all ease-in-out duration-500 flex overflow-auto fixed top-0 z-10 left-0 h-full bg-primary text-white shadow-md flex-col md:hidden justify-between w-0">
        <div class="p-8 py-20">
            <ul class="flex flex-col space-y-3 font-semibold divide-y-2">
                <li class="p-2">
                    <Link :href="route('home')" :class="{
                        'font-bold':
                            $page.url === '/',
                    }">A propos
                    </Link>
                </li>
                <li class="p-2">
                    <Link v-if="$page.props.auth && $page.props.auth.user" :href="route('home')" method="post" as="button">
                    Déconnexion
                    </Link>
                    <Link v-else :href="route('home')">Se connecter</Link>
                </li>
            </ul>
        </div>
        <div class="w-full p-4 text-sm flex flex-col text-center">
            <span> Passway 1.0</span>
            <span class="text-center">
                &copy; {{ currentYear }} Passway . Tous droits reservés.
            </span>
        </div>
    </div>
</template>
