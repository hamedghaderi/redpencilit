<template>
    <div class="modal z-50">
        <span class="modal__close">
            <i class="la la-times text-3xl" @click="close"></i>
<!--            <img src="/images/cross-out.svg" alt="cross out icon" @click="close">-->
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
            close() {
                this.$emit('closeModal')
            },
        }
    }
</script>
