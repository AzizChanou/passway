<script setup>
import { Link } from "@inertiajs/vue3";

const currentYear = new Date().getFullYear();
</script>

<template>
    <div id="menu"
        class="transition-all ease-in-out duration-500 flex overflow-hidden fixed top-0 z-10 left-0 h-full bg-primary text-white shadow-md flex-col lg:hidden justify-between w-0">
        <div class="p-8 py-24">
            <ul class="flex flex-col space-y-3 divide-y-2">
                <li class="p-2" :class="{
                    'font-bold':
                        $page.url === '/' || $page.url == '/search?q=*',
                }">
                    <Link :href="route('home')">
                    Accueil
                    </Link>
                </li>
                <li class="p-2" v-if="$page.props.auth.user" :class="{
                    'font-bold':
                        $page.url === '/dashboard',
                }">
                    <Link :href="route('dashboard')">
                    Dashboard
                    </Link>
                </li>
                <li class="p-2" :class="{
                    'font-bold':
                        $page.url === '/contact',
                }">
                    <Link :href="route('contact')">
                    Contacts
                    </Link>
                </li>
                <li class="p-2" :class="{
                    'font-bold':
                        $page.url === '/about',
                }">
                    <Link :href="route('faqs')">
                    FAQs
                    </Link>
                </li>
                <li class="p-2">
                    <Link v-if="$page.props.auth && $page.props.auth.user" :href="route('logout')" method="post"
                        as="button">
                    Déconnexion
                    </Link>
                </li>
            </ul>
        </div>
        <div class="w-full p-4 text-sm flex flex-col text-center">
            <span> Passway 0.1.0</span>
            <span class="text-center">
                &copy; {{ currentYear }} Passway . Tous droits reservés.
            </span>
        </div>
    </div>
</template>
