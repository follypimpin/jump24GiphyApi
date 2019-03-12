<template>
    <v-app>
        <nav-bar></nav-bar>
        <v-content transition="slide-x-transition">
            <v-container fluid>
                <router-link tag="li" to="/">Home</router-link>
                <router-link tag="li" to="/about">About</router-link>

                <!-- The router view tag will display the current page that you are on.-->
                <router-view></router-view>
            </v-container>
        </v-content>
        <v-footer app></v-footer>

    </v-app>

</template>

<script>
    import NavBar from "../layouts/NavBar";
    export default {
        name: "App",
        components: {NavBar}
    }
</script>

<style>

</style>