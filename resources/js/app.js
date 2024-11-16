import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import {Link} from "@inertiajs/inertia-vue3";
import {Head} from "@inertiajs/inertia-vue3";
import Layout from './Shared/Layout';

createInertiaApp({
    resolve: async name => {
        let page = (await import(`./Pages/${name}.vue`)).default;
        if(page.layout === undefined) page.layout = Layout;
        return page;
    }, // This dynamically loads components in your Pages directory
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            //an alternative way to define the component globally,
            // if you use this way you need to remove the link from components in the related vue file !!
            .component('Link', Link)
            .component('Head', Head)
            .mount(el);
    },
    title : title => `My App: ${title}`,
});

InertiaProgress.init({ color: '#4B5563', showSpinner: true });
