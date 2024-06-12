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

const app = createApp(App)
app.use(LaravelPermissionToVueJS)
// app.mount('#app')

axios.get('/get-permissions').then(
  response => {
    window.Laravel.jsPermissions = response.data;
  }
);

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
