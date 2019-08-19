<template>
    <div class="dropdown" :class="classes">
        <div @click="isOpen = !isOpen">
            <slot name="toggler"></slot>
        </div>

        <transition name="collapse">
            <div v-if="isOpen">
                <slot></slot>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        props: ['classes'],

        data() {
            return {
               isOpen: false
            }
        },

        watch: {
            isOpen(isOpen) {
                if (isOpen) {
                    document.addEventListener('click', this.closeOpenedDropdown);
                }
            }
        },

        methods: {
            closeOpenedDropdown(event) {
                if (! event.target.closest('.dropdown')) {
                   this.isOpen = false;
                }
            }
        }
    }
</script>

<style>
    .collapse-enter-active, .collapse-leave-active {
        transition: all .5s;
        transform: translateY(0);
    }
    .collapse-enter, .collapse-leave-to {
        opacity: 0;
        transform: translateY(7px);
    }
</style>