<template>
    <span @change="test">
        <input
                type="text"
                v-model="model"
                name="upload_articles_per_day"
                :readonly="!showEdit"
                :class="{ 'dashboard-input': showEdit }">
    </span>
</template>

<script>
    export default {
        props: ['model'],

        data() {
            return {
                [this.model]: ''
            }
        },

        methods: {
            test() {
                console.log('hello');
            }
        }
    }
</script>

<style>

</style>