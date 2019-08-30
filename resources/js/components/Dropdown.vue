<template>
    <div class="dropdown" :class="classes">
        <div @click.prevent="toggleDropdown">
            <slot name="toggler"></slot>
        </div>

        <transition name="collapse">
            <div v-if="isOpen" class="dropdown-content">
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
                if (!event.target.closest('.dropdown')) {
                    this.isOpen = false;
                    window.events.$emit('dropdownToggled', this.isOpen);
                }
            },

            toggleDropdown() {
                this.isOpen = !this.isOpen;
                window.events.$emit('dropdownToggled', this.isOpen);
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

    .dropdown-content {
        position: absolute;
        min-width: 100%;
    }

    .dropdown-left .collapse-enter-active,
    .dropdown-left .collapse-leave-active {
        transform: translateX(0);
    }

    .dropdown-left .dropdown-content {
        top: 0;
        right: 100%;
        transform: translateX(0px);
    }

    .dropdown-left .collapse-enter, .dropdown-left .collapse-leave-to {
        opacity: 0;
        transform: translateX(-7px);
    }
</style>