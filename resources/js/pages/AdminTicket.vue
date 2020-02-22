<template>
    <div>
        <div class="mb-12 p-6 bg-white rounded shadow">
            <div class="flex items-center border-b border-grey-light pb-4 mb-4">
                <h3 class="text-grey-darker">
                    {{ ticket.title }}
                </h3>

                <div class="text-grey-dark text-xs flex flex-wrap items-center" :class="{'mr-auto': locale === 'fa',
                'ml-auto': locale === 'en'}">
                    <i class="las la-user-tie text-base text-grey"></i>

                    {{ ticket.owner.name }}

                    <p class="text-grey-dark flex items-center" :class="{'mr-4': locale === 'fa', 'ml-4': locale
                    === 'en'}">
                        <i class="las la-calendar text-base text-grey"></i>
                        {{ moment(ticket.created_at).locale(locale).fromNow() }}
                    </p>
                </div>
            </div>

            <div class="text-grey-dark mb-8">
                {{ ticket.body }}
            </div>

            <div v-if="active">
                <div class="mb-4">
                    <textarea v-model="body" name="body" id="body" rows="10" class="input"
                              :placeholder="bodyPlaceHolder"></textarea>

                    <div v-if="errors.has('body')" class="feedback feedback--invalid">
                        {{ errors.get('body') }}
                    </div>
                </div>

                <button class="button button--primary" @click="addReply">{{ 'Send Reply' }}</button>
                <button class="button button--smooth--danger" @click="cancel">{{ 'cancel' }}</button>
            </div>

            <button v-if="!active" class="button button--smooth--primary" @click="active = true">
                {{ trans.get('__JSON__.Add a reply') }}
            </button>
        </div>

        <div v-for="reply in ticket.replies" class="bg-white mb-4 rounded p-6 border border-transparent"
             :class="{'border-indigo-lighter': reply.owner.isAdmin}">
            <div class="flex items-center">
                <p class="text-sm text-grey-dark">
                    <span class="bg-grey text-xs p-1 rounded text-white" v-if="reply.owner.isAdmin">Admin</span>

                    {{ trans.get('__JSON__.Replied by') + ' ' + reply.owner.name + ' ' + trans.get('__JSON__.at') + ' '
                    +
                    moment(reply.created_at).locale(locale).fromNow() }}
                </p>

                <div :class="{'mr-auto': locale === 'fa', 'ml-auto': locale === 'en'}">
                    <button @click="deleteReply(reply)"
                            class="text-xs bg-white border rounded p-2 hover:bg-red hover:text-white hover:border-red">
                        {{ trans.get('__JSON__.delete') }}
                    </button>
                </div>

            </div>

            <hr class="mb-4">

            <div class="text-grey-darker">{{ reply.body }}</div>
        </div>
    </div>
</template>

<script>
    // import moment from 'moment';
    import moment from 'jalali-moment';
    import Errors from "../Errors";

    export default {
        props: ['ticketdata'],

        created() {
            this.ticket = this.ticketdata;
            this.moment = moment;
        },

        data() {
            return {
                locale: window.Redpencilit.locale,
                ticket: {},
                active: false,
                body: '',
                moment: '',
                errors: new Errors(),
            }
        },

        computed: {
            bodyPlaceHolder() {
                return this.trans.get('__JSON__.Your reply...');
            }
        },

        methods: {
            addReply() {
                let url = `/${this.locale}/tickets/${this.ticket.id}/replies`;

                axios.post(url, {
                    body: this.body
                }).then(response => {
                    console.log(response);
                    this.body = '';
                    this.active = false;
                    let message = this.trans.get('__JSON__.Your reply has been created successfully');
                    flash(this.trans.get(message));
                    this.ticket.replies.unshift(response.data);
                }).catch(error => {
                    this.errors.record(error.response.data.errors);
                });
            },

            cancel() {
                this.active = false;
                this.body = '';
                this.errors.clear();
            },

            deleteReply(reply) {
                let url = `/${this.locale}/replies/${reply.id}`;

                axios.delete(url).then(response => {
                    this.ticket.replies = this.ticket.replies.filter(currentReply => {
                        return currentReply.id !== reply.id
                    });
                })
            }
        }
    }
</script>

<style>
</style>
