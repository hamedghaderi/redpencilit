<template>
    <div :id="name" class="overlay">
        <a href="#" class="pin-l pin-r pin-t pin-b absolute"></a>
        <a href="#" class="modal-close text-white absolute pin-r pin-top mr-4 mt-4">
            <i class="las la-times text-4xl"></i>
        </a>

        <div class="modal-content relative">
            <slot></slot>


        </div>
    </div>
</template>

<script>
    export default {
        props: ['name'],
    }
</script>

<style>
    .overlay {
        visibility: hidden;
        position: fixed;
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .7);
        z-index: 1001;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity .3s;
    }

    .overlay:target {
        visibility: visible;
        opacity: 1;
    }

    .modal-content {
        background: white;
        width: 600px;
        max-width: 80%;
        padding: 2.5em;
        border-radius: .4rem;
    }

    .modal-close {
        top: 10px;
        left: 10px;
    }
</style>
