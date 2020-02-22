<template>
    <div class="px-6">
        <div class="bg-white p-8 mb-4 rounded shadow" v-for="ticket in tickets">
            <div class="flex">
                <h2 class="text-grey-darker text-lg">{{ ticket.title }}</h2>

                <div class="flex items-center" :class="{'mr-auto': locale === 'fa', 'ml-auto': locale === 'en'}">
                   <span class="text-grey-dark text-xs">{{ ticket.replies.length + ' ' + trans.get('__JSON__.replies')
                    }}</span>

                        <span class="text-grey"
                              :class="{'mr-4': locale === 'fa', 'ml-4': locale === 'en'}"
                              v-if="ticket.attachment">|</span>

                       <a v-if="ticket.attachment" class="text-grey-dark inline-flex items-center text-xs"
                          :class="{'mr-4': locale === 'fa', 'ml-4': locale === 'en'}"
                          :href="attachmentUrl(ticket)"
                          :download="ticket.attachment">
                    <i class="text-grey las la-file-download text-2xl"></i>
                    {{ trans.get('__JSON__.download attachment') }}
                    </a>
                </div>
            </div>

            <hr class="mb-1">

            <div class="text-grey-dark leading-loose">
                {{ ticket.body }}

                <div class="mt-2 text-right">
                    <a :href="replyLink(ticket)" class="button button--smooth--primary text-xs px-2 py-1">
                        {{ trans.get('__JSON__.Add a reply') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['collection'],

        name: "TicketList",

        created() {
            this.tickets = this.collection;

            window.events.listen('ticketcreated', (ticket) => {
                this.tickets.unshift(ticket);
            });
        },

        data() {
            return {
                tickets: this.ticketsdata,
                locale: window.Redpencilit.locale
            }
        },

        methods: {
            attachmentUrl(ticket) {
                return `/${this.locale}/tickets/${ticket.id}/attachment`;
            },

            replyLink(ticket) {
                return `/${this.locale}/tickets/${ticket.id}`;
            }
        }
    }
</script>

<style>

</style>
