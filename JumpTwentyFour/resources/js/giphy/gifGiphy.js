import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';
import gifs from '@/js/api';

Vue.use(Vuex);

const gifGiphy = new Vuex.Store({
    state:{
        gifs: [],
        randomGifs: []
    },
    mutations:{
        FETCH(state, gifs) {
            state.gifs = gifs;
        },
        FETCH_TRENDING(state, trendingGifList) {
            state.trendingGifList = trendingGifList;
        }

    },
    actions: {
        fetch({commit}) {
            return axios.get(gifs)
                .then(response => commit('FETCH', response.data))
                .catch();
        },
      /*  trending({}, id) {
            axios.get(`${gifs}/${id}`)
                .then(response => commit('FETCH', response.data))
                .catch();
        },*/
        search({},start_date,end_date){
            axios.post(`${gifs}/search`,{
                start_date: start_date,
                end_date: end_date
            })
                .then(response => commit('FETCH', response.data))
                .catch();
        },
        fetchTrending({commit}) {
            return axios.get(`${gifs}/?id=2`)
                .then(response => commit('FETCH_TRENDING', response.data))
                .catch();
        },
        random({},id,query){
            axios.post(`${gifs}/random`,{
                id: id,
                query: query
            })
                .then(response => commit('FETCH', response.data))
                .catch();
        }

    }
});

export default gifGiphy;