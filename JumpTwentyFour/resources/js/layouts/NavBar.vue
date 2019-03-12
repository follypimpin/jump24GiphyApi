<template>
    <!-- <v-toolbar> I have added the prop app. This prop designates the component as part of the application layout-->
    <v-toolbar app color="blue darken-2" dark>
        <v-toolbar-side-icon></v-toolbar-side-icon>
        <v-toolbar-title></v-toolbar-title>
        <v-btn flat class="hidden-sm-and-down">Menu</v-btn>
        <v-spacer class="hidden-sm-and-down"></v-spacer>
        <v-btn flat class="hidden-sm-and-down">SIGN IN</v-btn>
        <v-btn color="blue lighten-3" class="hidden-sm-and-down">JOIN</v-btn>
    </v-toolbar>
</template>

<script>
    export default {
        name: "NavBar"
    }
</script>

<style scoped>

</style>