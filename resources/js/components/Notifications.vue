<template>
    <dropdown :classes="{'z-60': true, 'mr-auto': locale === 'fa', 'ml-auto': locale === 'en'}">
        <template v-slot:toggler>
           <span class="relative cursor-pointer" :class="{'mr-auto': locale === 'fa', 'ml-auto': locale === 'en'}">
               <i class="las la-bell text-2xl text-grey"></i>

                <span v-if="notifications.length != 0"
                      class="absolute pin-l pin-t bg-pink text-white rounded-full w-4 h-4 flex items-center justify-center"
                      style="font-size:9px; transform: translate(-30%, -30%);">
                   {{ notifications.length }}
                </span>
           </span>
        </template>

        <div :class="{'mr-auto': this.locale === 'fa'}">
            <div class="pt-2 pb-2 border-b" v-if="notifications.length !== 0">
                <a
                        @click="clearAll"
                        class="bg-orange-lightest
                               text-orange
                               rounded
                               text-xs
                               px-2
                               py-1
                               inline-flex
                               items-center
                               mb-2
                               cursor-pointer
                               hover:bg-orange
                               hover:text-white">
                    <i class="las la-times ml-1"></i>
                    {{ trans.get('__JSON__.Mark all as read') }}
                </a>
            </div>

            <ul class="bg-white text-grey-dark px-2 py-8 block text-xs relative">
                <li v-if="notifications.length !== 0" v-for="notification in notifications">
                    <a :href="notification.data.link" @click.prevent="markAsRead(notification)">
                        {{ notification.data.message[locale] }}
                    </a>
                </li>

                <li v-if="notifications.length === 0">
                    {{ trans.get("__JSON__.You don't have any notifications at this time") }}
                </li>
            </ul>
        </div>
    </dropdown>
</template>

<script>
    export default {
        data() {
            return {
                notifications: [],
                locale: window.Redpencilit.locale
            }
        },

        created() {
            let url = `/${this.locale}/profile/${window.Redpencilit.user.id}/notifications`;

            axios.get(url).then(res => {
                this.notifications = res.data;
            });
        },

        methods: {
            markAsRead(notification) {
                let url = `/${this.locale}/profile/${window.Redpencilit.user.id}/notifications/${notification.id}`;

                axios.delete(url);

                window.location = notification.data.link;
            },

            clearAll() {
                let url = `/${this.locale}/profile/${window.Redpencilit.user.id}/notifications`;

                axios.delete(url).then(response => {
                  this.notifications = [];
                });
            }
        }
    }
</script>

<style>

</style>
