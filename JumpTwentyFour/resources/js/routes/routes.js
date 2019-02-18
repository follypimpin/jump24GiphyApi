import SearchGif from '@/js/components/SearchGif.vue';
import TrendingGifList from '@/js/components/TrendingGifList.vue';
import List from '@/js/components/List';

import Home from '@/js/components/Home';

/*Vue.use(VueRouter);*/
const routes = [
    { path: '/', component: List },
    { path: '/list', component: List },
    { path: '/search', component: SearchGif },
    { path: '/trending-gif-list', component: TrendingGifList },
    { path: '*', redirect: '/list' },
];
console.log(routes);
export default routes;