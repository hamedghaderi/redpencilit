<template>
    <button class="button button--outline button--outline--danger dropdown-toggler" @click="click">
        <slot></slot>
        <i class="fas fa-caret-down"></i>
    </button>
</template>

<script>
    export default {
        props: ['visible'],

        methods: {
            click() {
                this.$emit('toggle')
            }
        },
    }
</script>