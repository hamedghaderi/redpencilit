<template>
    <div class="w-full">
        <div class="p-6">
            <div class="bg-white shadow p-6 rounded mb-12">
                <div class="flex flex-wrap items-center border-b border-grey-lighter pb-3 mb-3">
                    <h3 class="text-base md:text-lg flex items-center text-grey-darker mb-4">
                        <span class="text-grey ml-1">
                            <i class="las la-ticket-alt text-2xl"
                               :class="{'mr-2': locale === 'en', 'ml-2': locale === 'fa'}"></i>
                        </span>
                        {{ trans.get('__JSON__.Send New Ticket')  }}
                    </h3>
                    <p class="text-grey-dark w-full text-sm">
                        {{ trans.get(`__JSON__.If you have any problem, just sent a ticket and we will help you as soon as possible.`) }}
                    </p>
                </div>

                <form class="w-full" action="#" method="POST"
                      enctype="multipart/form-data">

                    <div class="mb-4">
                        <label class="label" for="title">{{ trans.get('__JSON__.subject') }}</label>
                        <input class="input" type="text" name="title" id="title" v-model="title">

                        <p class="feedback feedback--invalid my-2" v-if="errors.has('title')">
                            {{ errors.get('title') }}
                        </p>
                    </div>

                    <div class="mb-4">
                        <label class="label" for="body">{{ trans.get('__JSON__.message') }}</label>
                        <textarea class="input" name="body" id="body" rows="5" v-model="body"></textarea>

                        <p class="feedback feedback--invalid my-2" v-if="errors.has('body')">
                            {{ errors.get('body') }}
                        </p>
                    </div>

                    <div class="mb-8">
                        <attachment inline-template v-cloak>
                            <div>
                                <label class="label">{{ trans.get('__JSON__.attachment') }}</label>
                                <label for="attachment" class="border border-grey pr-8 pl-4 py-4 block inline-flex
                        items-center justify-center rounded text-grey-darker mb-2 text-sm relative w-full
                        cursor-pointer hover:bg-grey-lighter hover:shadow">
                                <span class="absolute pin-t h-full w-8 flex
                                items-center justify-center text-base
                                @if (app()->getLocale() === 'fa') pin-r mr-4 @else pin-l ml-4 @endif">
                                    <i class="las la-paperclip text-xl"></i>
                                </span>
                                    <span class="@if (app()->getLocale() === 'fa') pr-4 @else @endif">
                                {{ trans.get('__JSON__.Add Attachment') }}
                            </span>
                                </label>

                                <input type="file" name="attachment" class="hidden" id="attachment"
                                       v-on:change="uploadFile">
                                <div class="bg-green-lightest text-green-darker p-4 rounded-br rounded mb-2 relative"
                                     v-if="showAttachmentName"
                                >
                                    {{ trans.get('__JSON__.Selected file name ') }} <span
                                        class="bg-green-dark rounded px-2 py-1
                                    text-xs text-green-lighter">@{{
                                        filename }}</span>

                                    <span class="absolute text-green-darker cursor-pointer"
                                          :class="{'pin-l': locale === 'fa', 'pin-r': locale === 'en', 'mr-4': locale
                                           === 'en', 'ml-4': locale === 'fa'}"
                                          @click="clearFile">
                                        <i class="las la-times text-lg"></i>
                                    </span>
                                </div>

                                <p class="text-xs text-grey-dark">
                                    {{ trans.get('__JSON__.If you have something to upload click on the top section') }}
                                </p>

                                <p class="feedback feedback--invalid my-2" v-if="errors.has('attachment')">
                                    {{ errors.get('attachment') }}
                                </p>
                            </div>
                        </attachment>
                    </div>

                    <button class="button button--primary" @click.prevent="saveTicket">
                        {{ trans.get('__JSON__.Create Ticket') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import Errors from "../Errors";

    export default {
        name: "Ticket",

        created() {
            this.locale = window.Redpencilit.locale;
        },

        data() {
            return {
                title: '',
                body: '',
                attachment: '',
                locale: 'fa',
                errors: new Errors()
            }
        },

        methods: {
            saveTicket() {
                let url = `/${this.locale}/tickets`;

                let formData = new FormData();
                let file = document.getElementById('attachment').files[0];

                if (file) {
                    formData.append('attachment', file);
                }

                formData.set('title', this.title);
                formData.set('body', this.body);

                axios.post(url, formData).then(response => {
                    this.title = '';
                    this.body = '';
                    let message = this.trans.get("__JSON__.Your tickets has been created. A notification will send to you as soon as our support team make a reply.");
                    flash(message);
                    window.events.fire('ticketcreated', response.data);
                }).catch(error => {
                    console.log(error);
                    this.errors.record(error.response.data.errors);
                    window.events.fire('erroroccured', error.response.data.errors);
                });
            }
        }
    }
</script>

<style scoped>

</style>
