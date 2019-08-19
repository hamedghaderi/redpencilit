<template>
    <div class="modal">
        <span class="modal__close">
            <img src="/images/cross-out.svg" alt="cross out icon" @click="onClose">
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
            onClose() {
                this.$emit('closeModal')
            },
        }
    }
</script>
