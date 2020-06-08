<template>
    <div class="modal z-50" @click="close">
        <span class="modal__close">
            <i class="la la-times text-3xl" @click="close"></i>
        </span>

        <div class="modal__wrapper">
            <div class="modal__body">
                <slot></slot>
            </div>

            <div class="modal__footer">
                <slot name="footer"></slot>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            close(event) {
                if (! event.target.closest('.modal__wrapper')) {
                    this.$emit('closeModal')
                }
            },
        }
    }
</script>
