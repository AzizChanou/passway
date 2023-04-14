import './bootstrap';
import 'maz-ui/css/main.css';
import "swiper/css/navigation";
import "swiper/css/pagination";
import "swiper/css";
import '../css/app.css';
import './helpers/toast';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { installToaster } from 'maz-ui';
import MazBtn from 'maz-ui/components/MazBtn';
import Mazinput from 'maz-ui/components/MazInput';
import MazDropzone from 'maz-ui/components/MazDropzone';
import { createPinia } from 'pinia';
import PrimeVue from 'primevue/config';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Passway';

const toasterOptions = {
    position: 'top-right',
    timeout: 3000,
    persistent: false,
};
const pinia = createPinia()

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(pinia)
            .use(ZiggyVue, Ziggy)
            .use(PrimeVue, { ripple: true })
            .use(installToaster, toasterOptions)
            .component('MazBtn', MazBtn)
            .component('Mazinput', Mazinput)
            .component('MazDropzone', MazDropzone)
            .mount(el);
    },
    progress: {
        color: '#5645b7',
    },
});