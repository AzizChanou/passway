<script setup>
import Logo from '@/Components/Logo.vue';
import { Link } from '@inertiajs/vue3';

const showMenu = () => {
    navMenu.classList.toggle("active");
    menu.classList.toggle("w-full");
    menu.classList.toggle("w-0");
}

</script>

<template>
    <div class="h-16 w-full bg-primary p-4 flex items-center shadow z-30 sticky">
        <div class="max-w-screen-xl w-full flex justify-between items-center mx-auto">
            <Link :href="route('home')">
            <Logo color="light" class="h-12 p-2" />
            </Link>

            <div class="hidden md:flex text-white font-medium">
                <ul class="flex space-x-8">
                    <li class="p-1 border-b-2 border-transparent hover:border-b-white duration-300" :class="{
                        'border-b-white':
                            $page.url === '/',
                    }">
                        <Link :href="route('home')">Accueil
                        </Link>
                    </li>
                    <li class="p-1 border-b-2 border-transparent hover:border-b-white duration-300" :class="{
                        'border-b-white':
                            $page.url === '/about',
                    }">
                        <Link :href="route('about')">Menu
                        </Link>
                    </li>
                    <li class="p-1 border-b-2 border-transparent hover:border-b-white duration-300" :class="{
                        'border-b-white':
                            $page.url === '/about',
                    }">
                        <Link :href="route('about')">A propos
                        </Link>
                    </li>
                    <li class="p-1 border-b-2 border-transparent hover:border-b-white duration-300" :class="{
                        'border-b-white':
                            $page.url === '/bnm',
                    }">
                        <Link :href="route('about')"><i class="fi-sr-shopping-bag"></i>
                        </Link>
                    </li>
                </ul>
            </div>

            <div class="md:hidden">
                <div id="navMenu" @click="showMenu()" class="z-50 sticky">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </div>
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
