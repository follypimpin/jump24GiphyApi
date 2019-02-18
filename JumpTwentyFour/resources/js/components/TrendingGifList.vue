<template>
    <div>
        <ul class="list-group center">
            <div class="component-header">Trending List ({{ trendingListCount }})</div>
            <div v-if="trendingListCount">
                <li v-for="(gif, index) in trendingListCount" class="list-group-item">
                    <span>{{ gif.title }}</span>
                    <div class="col-sm-4">{{ gif.gif_id }}</div>
                    <div class="col-sm-8">
                        <img :src=" gif.embed_url" class="img-thumbnail" alt="gif"/>
                    </div>
                </li>
            </div>
        </ul>
    </div>
</template>

<script>
    import { mapState } from 'vuex';
    export default {
        mounted() {
            this.fetchTrending();
        },
        computed: {
            ...mapState([
                'trendingGifList'
            ]),
            trendingListCount() {
                return this.trendingGifList.length;
            }
        },
        methods: {
            fetchTrending() {
                this.$store.dispatch('fetchTrending');
            }
        },
    }
</script>


<style scoped>

</style>