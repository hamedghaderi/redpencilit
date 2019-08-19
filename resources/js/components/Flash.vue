<template>
    <transition name="slide">
        <div class="alert alert--flash fade show"
             :class="['alert--'+level, {'active': show}]"
             role="alert"
             v-if="show"
        >
            <span v-if="level === 'success'" class="alert__mark">
				<img src="/images/success.svg" alt="astronant">
            </span>

            <span v-if="level === 'danger'" class="alert__mark">
                <img src="/images/warning.svg" alt="a woman show warning">
            </span>

            <p>{{ body }}</p>
        </div>
    </transition>
</template>

<script>
    export default {
        props: ['message'],

        data() {
            return {
                body: this.message,
                level: 'success',
                show: false,
                speed: 5000
            }
        },

        created() {
            console.log(this.level);
            if (this.message) {
                this.flash();
            }

            window.events.$on('flash', data => this.flash(data));
        },

        methods: {
            flash(data) {
                if (data) {
                    this.body = data.message;
                    this.level = data.level;
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
    .alert {
        border-bottom: 1px solid white;
    }

    .alert::before {
        content: '';
        position: absolute;
        right: 0;
        bottom: 0;
        height: 3px;
        width: 100%;
    }

    .alert--success::before {
        background-color: #B2F5EA;
    }

    .alert--danger::before {
        background-color: #FED7D7;
    }

    .alert::after {
        content: '';
        position: absolute;
        right: 0;
        bottom: 0;
        height: 3px;
        width: 0;
    }

    .alert::after {
       animation: slide 5s ease-in;
    }

    .alert--success::after {
        background-color: #4FD1C5;
    }

    .alert--danger::after {
        background-color: #F56565;
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

