<template>
    <transition name="slide">
        <div class="alert alert--flash fade show"
             :class="['alert--'+level, {'active': show}, {'text-left': locale === 'en'}]"
             role="alert"
             v-if="show"
        >
            <p>{{ body }}</p>
        </div>
    </transition>
</template>

<script>
    export default {
        props: ['message', 'status'],

        data() {
            return {
                body: this.message,
                level: 'success',
                show: false,
                speed: 5000,
                locale: window.Redpencilit.locale
            }
        },

        created() {
            if (this.status) {
                this.level = this.status;
            }

            if (this.message) {
                this.flash();
            }

            window.events.listen('flash', data => this.flash(data));
        },

        methods: {
            flash(data) {
                if (data) {
                    this.body = data.message;
                    this.level = data.level ? data.level : this.level;
                }

                this.show = true;

                this.hide();
            },

            hide() {
                setTimeout(() => {
                    this.show = false;
                }, this.speed);
            }
        }
    }
</script>

<style>
    .alert::before,
    .alert::after {
        content: '';
        position: absolute;
        right: 0;
        bottom: 0;
        height: 3px;
    }

    .alert::before {
        width: 100%;
    }

    .alert::after {
        background-color: white;
        width: 0;
        animation: slide 5s ease-in;
    }

    .alert--warning::after {
        background-color: #453411;
    }

    .slide-enter-active, .slide-leave-active {
        transition: all .5s;
        transform: translateY(0);
    }

    .slide-enter, .slide-leave-to {
        opacity: 0;
        transform: translateY(7px);
    }

    @keyframes slide {
        from {
            width: 0;
        }
        to {
            width: 100%;
        }
    }
</style>

