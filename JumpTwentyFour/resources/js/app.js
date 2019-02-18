
/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

import './bootstrap';
import Vue from 'vue';
import VueRouter from 'vue-router';
import GifApp from '@/js/components/GifApp.vue';
import routes from '@/js/routes/routes';
import gifGiphy from '@/js/giphy/gifGiphy';


Vue.use(VueRouter);

const router = new VueRouter({
    routes
});

window.events = new Vue();
const app = new Vue({
    el: '#app',
    render: h => h(GifApp),
    router,
    store: gifGiphy,
});
console.log(app);
export default app;

