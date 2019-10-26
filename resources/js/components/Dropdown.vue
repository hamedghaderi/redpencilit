<template>
    <div class="dropdown relative z-50" v-cloak :class="classes">
        <div @click.prevent="toggleDropdown">
            <slot name="toggler"></slot>
        </div>

        <transition name="collapse">
            <div v-if="isOpen" class="dropdown-content bg-white shadow-lg rounded w-64 py-2 px-4 text-sm">
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
    .collapse-enter-active,
    .collapse-leave-active {
        transition: all .5s;
        transform: translateY(0);
    }

    .collapse-enter, .collapse-leave-to {
        opacity: 0;
        transform: translateY(7px);
    }

    .dropdown-content {
        position: absolute;
    }

    .dropdown-left .collapse-enter-active,
    .dropdown-left .collapse-leave-active {
        transform: translateX(0);
    }

    @media screen and (min-width: 768px) {
        .md-left .dropdown-content {
            right: 100% !important;
            bottom: auto !important;
            top: 0;
        }
    }

    .dropdown-left .dropdown-content {
        top: 0;
        right: 100%;
        transform: translateX(0px);
    }

    .dropdown-top .dropdown-content {
        bottom: 100%;
        right: 0;
    }

    .dropdown-left .collapse-enter,
    .dropdown-left .collapse-leave-to,
    .md-left .collapse-enter,
    .md-left .collapse-leave-to{
        opacity: 0;
        transform: translateX(-7px);
    }
</style>