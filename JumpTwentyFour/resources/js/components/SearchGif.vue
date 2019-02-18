<template>
    <template>
        <div class="gif-form">
            <div class="component-header">Search Random Migrated Gifs</div>
            <form @submit.prevent="search">
                <input v-model="start_date">
                <input v-model="end_date">
                <button type="submit">Search</button>
            </form>
        </div>
    </template>
</template>

<script>
    export default {
        data() {
            return {
                start_date: '',
                end_date: ''
            }
        },
        mounted() {
        },
        methods: {
            search() {
                this.$store.dispatch('search', this.start_date,this.end_date);
                this.$router.push('/list');
                //flash('Note Created.', 'success');
            }
        }
    }
</script>

<style scoped>

</style>