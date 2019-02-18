<template>
    <div>
        I am Gif component
    </div>
</template>

<script>
    import router from '@js/routes/routes';
    export default {
        name: "GifComponent",
        router,
        mounted() {
            console.log('I am from Gif Component.')
        }

    }
</script>

<style scoped>

</style>