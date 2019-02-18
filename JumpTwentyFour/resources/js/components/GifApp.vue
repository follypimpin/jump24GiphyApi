<template>
    <div>
        <div class="header-nav">

            <router-link to="/list">Gifs</router-link>
            <router-link to="/trending-gif-list">Trending Gifs</router-link>
            <router-link to="/search">Search Gif</router-link>
            <router-view></router-view>

        </div>


    </div>
</template>

<script>
    import axios from 'axios';
    import { mapState } from 'vuex';

    export default {
        name: "GifApp",
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style scoped>

</style>