import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import LaravelPermissionToVueJS from 'laravel-permission-to-vuejs';
// import App from './Components/Welcome.vue';
import App from './Layouts/AppLayout.vue';
import axios from 'axios';

axios.get('/get-permissions').then(
  response => {
    window.Laravel.jsPermissions = response.data;
  }
);

const app = createApp(App)
app.use(LaravelPermissionToVueJS)
// app.mount('#app') // No descomentar por que ya esta en la funcion createInertiaApp

// const fetchPermissions = async () => {
//     try {
//         const response = await axios.get('/get-permissions');
//         window.Laravel.jsPermissions = response.data;
//     } catch (error) {
//         console.error("Failed to fetch permissions", error);
//     }
// };

// // Initial fetch
// fetchPermissions();

// // Polling every 5 seconds
// setInterval(fetchPermissions, 5000);

// const app = createApp(App);
// app.use(LaravelPermissionToVueJS);

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(LaravelPermissionToVueJS)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
