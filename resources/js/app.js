import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "./vue.m";
import { createStore } from "vuex";

const store = createStore({
    state() {
        return {
            wordResponse: {},
            wordsHistory: [],
        };
    },
    mutations: {
        setWordResponse(state, response) {
            state.wordResponse = response;
        },
        setWordsHistory(state, response) {
            state.wordsHistory = response;
        },
    },
});

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(store)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
