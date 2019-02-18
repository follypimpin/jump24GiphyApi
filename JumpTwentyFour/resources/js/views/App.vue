<template>
    <v-app>
        <v-navigation-drawer app></v-navigation-drawer>
        <v-toolbar app></v-toolbar>
        <v-content>
            <v-container fluid>
                <router-link tag="li" to="/our-vue">Home</router-link>
                <!--- adding router view -->

            </v-container>
        </v-content>
        <v-footer app></v-footer>
    </v-app>
</template>
<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    };
</script>
