import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
    methods: {
        async submitForm() {
            this.loading = true;
            this.error = null;
            this.result = null;

            try {
                // ارسال درخواست به روت لاراول
                const response = await axios.post('/operation', this.formData);
                this.result = response.data.result; // فرض بر این است که بک‌اندر کلید result برمی‌گرداند
            } catch (err) {
                this.error = "خطایی در محاسبه رخ داد. لطفا ورودی‌ها را چک کنید.";
                console.error(err);
            } finally {
                this.loading = false;
            }
        }
    }
});
