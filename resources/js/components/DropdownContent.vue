<template>
    <ul class="mt-3" v-dropdown-outside-click="{ ref: 'dropdown', method: 'hide' }">
        <slot></slot>
    </ul>
</template>

<script>
    export default {
        mounted() {
           this.element = this.$el;
        },
        data() {
            return {
                element: null
            }
        },
        methods: {
            hide() {
                this.$emit('hideDropdown');
            }
        }
    }
</script>