<template>
    <span
            class="text-center py-1 rounded-full w-24 inline-flex items-center justify-center text-xs"
            :class="state">
        {{ text}}
    </span>
</template>

<script>
    export default {
        name: "Status",
        props: {
            status: {
                type: Number,
            }
        },
        data() {
            return {
                statusClasses: {
                    1: {
                        text: this.trans.get('__JSON__.Unfulfilled'),
                        class: 'bg-orange-lightest text-orange'
                    },
                    2: {
                        text: this.trans.get('__JSON__.Pending'),
                        class: 'bg-indigo-lightest text-indigo'
                    },
                    3: {
                        text: this.trans.get('__JSON__.Fulfilled'),
                        class: "bg-green-lightest text-green",
                    },
                }
            }
        },
        computed: {
            state() {
               return this.statusClasses[this.status].class;
            },

            text() {
                return this.statusClasses[this.status].text;
            }
        }
    }
</script>

<style scoped>

</style>
