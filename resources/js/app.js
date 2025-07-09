import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';


//Kanan Primevue ini 
import PrimeVue from 'primevue/config';
import Aura from '@primeuix/themes/aura';

import 'primeicons/primeicons.css';

//kanan toast an pop up notif
import ToastService from 'primevue/toastservice';
import Toast from 'primevue/toast';

// Tas adi an kanan text box ini gin global para matawag bis ngain
import FloatLabel from 'primevue/floatlabel';
import InputText from 'primevue/inputtext';

// adi an scroll animation
import AnimateOnScroll from 'primevue/animateonscroll';
import Tooltip from 'primevue/tooltip';

import AOS from 'aos'
import 'aos/dist/aos.css'


const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });

        app.use(plugin);
        app.use(ZiggyVue);
        app.use(PrimeVue, {
            theme: {
                preset: Aura
            }
        });
        
        // amo ini an knan toast
        app.use(ToastService);
        app.component('Toast', Toast);
        // amo ini an component para han global input box
        app.component('FloatLabel', FloatLabel);
        app.component('InputText', InputText);
        // amo ini an kanan animate on scroll
        app.directive('animateonscroll', AnimateOnScroll);
        //adi kanan tool tip
        app.directive('tooltip', Tooltip);


               // ✅ Mixin to handle AOS initialization and refresh
        app.mixin({
            mounted() {
                AOS.init({
                    // Optional: customize global settings
                    once: true,
                    duration: 800,
                });
            },
            updated() {
                AOS.refresh();
            },
        });

        app.mount(el);
    
    },
    progress: {
        color: '#4B5563',
    },
});
