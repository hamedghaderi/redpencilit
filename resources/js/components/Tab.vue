<template>

</template>

<script>
    export default {
        props: ['name'],

        methods: {
            onClick() {
                this.$emit('clicking', this.target.name);
            }
        }
    }
</script>