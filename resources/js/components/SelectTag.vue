<template>
    <div class="relative mr-1 w-32" id="select-tag">
        <span class="rounded-full px-4 py-2 cursor-pointer block w-full"
              :class="{'bg-yellow text-yellow-darker': currentStatus === 1,
              'bg-indigo text-white': this.currentStatus === 2,
              'bg-green text-white': this.currentStatus === 3}"
              @click="active = !active">
            <i class="las la-angle-down"></i>
            {{ statuses[currentStatus] }}
        </span>

        <div v-if="active" class="absolute bg-white rounded px-4 pt-6 pb-2 w-full shadow mt-2 z-10"
             style="top:
        100%; left: 0;">
            <div>
               <span class="block mb-2 pb-2 cursor-pointer hover:text-indigo" v-for="(item, key, index) in
               statuses"
                     @click="changeStatus(key)">
                    {{ item }}
               </span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['status', 'order_id'],

        created() {
            this.currentStatus = this.status;

            document.body.addEventListener('click', this.closeSelect);
        },


        data() {
            return {
                currentStatus: 1,

                active: false,

                statuses: {
                    1: this.trans.get('__JSON__.Unfulfilled'),
                    2: this.trans.get('__JSON__.Pending'),
                    3: this.trans.get('__JSON__.Fulfilled')
                },

                locale: window.Redpencilit.locale,

                classObject: {
                    "bg-yellow text-yellow-darker": this.currentStatus === 1,
                    "bg-indigo text-indigo-darker": this.currentStatus === 2,
                    "bg-green text-green-darker": this.currentStatus === 3
                },
            }
        },

        computed: {},

        methods: {
            changeStatus(state) {
                this.active = false;
                const url = `/${this.locale}/admin/orders/${parseInt(this.order_id)}/statuses`;
                axios.post(url, {
                    'status': state
                }).then(res => {
                    this.currentStatus = parseInt(state);
                    flash(this.trans.get('__JSON__.Status has changed'))
                });
            },

            closeSelect(event) {
                if (!event.target.closest('#select-tag')) {
                    this.active = false;
                }
            }
        }
    }
</script>

<style>

</style>
