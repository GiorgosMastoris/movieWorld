import {createApp, h} from 'vue'
import {createInertiaApp, Head, Link} from '@inertiajs/vue3'
import Layout from "../js/Layouts/Layout.vue";
import {ZiggyVue} from 'ziggy-js';
import {Ziggy} from './ziggy';

import '../css/app.css';

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', {eager: true})
        let page = pages[`./Pages/${name}.vue`]
        page.default.layout = Layout
        return pages[`./Pages/${name}.vue`]
    },
    setup({el, App, props, plugin}) {
        createApp({render: () => h(App, props)})
            .use(plugin)
            .use(ZiggyVue, props.ziggy)
            .component("Head", Head)
            .component("Link", Link)
            .mount(el)
    },
})
