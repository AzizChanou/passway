<script setup>
import Logo from '@/Components/Logo.vue';
import { Link, router } from '@inertiajs/vue3';
import useThrottle from '@/helpers/useThrottle';
import { ref } from 'vue';

const showMenu = () => {
    navMenu.classList.toggle("active");
    menu.classList.toggle("w-full");
    menu.classList.toggle("w-0");
}

const recherche = ref(null);

const searchEvents = useThrottle(() => {
    router.get(route('search'), { q: recherche.value }, { preserveState: true });
}, 500)

</script>

<template>
    <header class="p-4 bg-primary text-gray-100 shadow z-30 sticky">
        <div class="container flex justify-between h-14 mx-auto max-w-screen-xl items-center">
            <Link :href="route('home')">
            <Logo color="light" class="h-12 p-2" />
            </Link>
            <ul class="items-stretch hidden space-x-3 md:flex">
                <li :class="{
                    'text-tertiary border-tertiary':
                        $page.url === '/' || $page.url == '/search?q=*',
                }">
                    <Link :href="route('home')"
                        class="flex items-center px-4 -mb-1 border-b-2 border-transparent hover:text-tertiary hover:border-tertiary">
                    Accueil
                    </Link>
                </li>
                <li v-if="$page.props.auth.user" :class="{
                    'text-tertiary border-tertiary':
                        $page.url === '/dashboard',
                }">
                    <Link :href="route('dashboard')"
                        class="flex items-center px-4 -mb-1 border-b-2 border-transparent hover:text-tertiary hover:border-tertiary">
                    Dashboard
                    </Link>
                </li>
                <li :class="{
                    'text-tertiary border-tertiary':
                        $page.url === '/contact',
                }">
                    <Link :href="route('contact')"
                        class="flex items-center px-4 -mb-1 border-b-2 border-transparent hover:text-tertiary hover:border-tertiary">
                    Contacts
                    </Link>
                </li>
                <li :class="{
                    'text-tertiary border-tertiary':
                        $page.url === '/about',
                }">
                    <Link :href="route('about')"
                        class="flex items-center px-4 -mb-1 border-b-2 border-transparent hover:text-tertiary hover:border-tertiary">
                    A propos
                    </Link>
                </li>
            </ul>
            <div class="md:hidden">
                <div id="navMenu" @click="showMenu()" class="z-50 sticky">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </header>
</template>


<style>
#navMenu>span {
    display: block;
    width: 22px;
    height: 3px;
    border-radius: 99999px;
    background-color: white;
}

#navMenu>span:not(:last-child) {
    margin-bottom: 6px;
}

#navMenu,
#navMenu>span {
    transition: all 0.2s ease-in-out;
}

#navMenu.active {
    transition-delay: 0.1s;
    transform: rotate(45deg);
}

#navMenu.active>span:nth-child(2) {
    width: 0;
}

#navMenu.active>span:nth-child(1),
#navMenu.active>span:nth-child(3) {
    transition-delay: 0.2s;
}

#navMenu.active>span:nth-child(1) {
    transform: translateY(9px);
}

#navMenu.active>span:nth-child(3) {
    transform: translateY(-9px) rotate(90deg);
}
</style>
