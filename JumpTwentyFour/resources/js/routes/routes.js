import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from '@/js/components/Home';

Vue.use(VueRouter);

const router = new VueRouter({
      routes: [
        {
            path: '/our-vue',
            component: Home
        }
    ]
});
console.log(router);
export default router;