<template>
    <transition name="slide">
        <div class="alert alert--flash fade show"
            :class="['alert--'+level, {'active': show}]"
            role="alert"
            v-if="show"
            >
            <span v-if="level === 'success'" class="alert__mark"> <i class="fas fa-check"></i> </span>
            <span v-if="level === 'danger'" class="alert__mark"> <i class="fas fa-times"></i> </span>

            {{ body }}
        </div>
    </transition>
</template>

<script>
    export default {
        props: ['message'],

        data() {
            return {
                body: '',
                level: 'success',
                show: false
            }
        },

        created() {
            if (this.message) {
                this.flash(this.message);
            }

            window.events.$on('flash', data => this.flash(data));
        },

        methods: {
            flash(data) {
                this.body = data.message;
                this.level = data.level;
                this.show = true;

                this.hide();
            },

            hide() {
                setTimeout(() => {
                    this.show = false;
                }, 3000);
            }
        }
    }
</script>

<style>
    .alert {
        border-bottom: 1px solid white;
    }
</style>

