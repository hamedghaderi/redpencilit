<template>
    <div class="modal">
        <span class="modal__close">
            <i class="fas fa-times" @click="onClose"></i>
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
