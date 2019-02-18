<template>
    <div>
        <ul class="list-group center">
            <div class="component-header"> Gif({{ gifsLength }})</div>
            <li v-for="(gif, index) in gifs" class="list-group-item" v-if="gifsLength">
                <div class="row">
                    <div class="col-sm-7">
                        <span>{{ gif.title }}</span>
                        <span>{{ gif.trending_datetime }}</span>
                    </div>
                    &nbsp;
                    <!--<div class="col-sm-4">{ gif.gif_id }}</div>
                    <div class="col-sm-8">
                        <img src="{{ gif.embed_url}}" class="img-thumbnail" alt="gif"/>
                    </div>-->


                </div>
            </li>
            <div v-else>No Gifs Found


            </div>
            <!--<div>
                Random Gifs
                <div class="glyphicon glyphicon-ok" @click="random(id)"
                     v-model="query">

                </div>

            </div>-->

        </ul>
        <!-- <div class="glyphicon glyphicon-ok" @click="trending()"
             ></div>-->
    </div>
</template>

<script>
    export default {
        name: "List",
        data() {
            return {
                id: 2,
                query: ''
            }
        },
        mounted() {
            this.$store.dispatch('fetch');
        },
        methods: {

          /*  random(id) {
                this.$store.dispatch('random', {id: id, query:  this.query});

            },*/
        },
        computed: {
            ...mapState(['gifs']),
            gifsLength() {
                return this.gifs.length;
            }
        }
    }
</script>

<style scoped>

</style>