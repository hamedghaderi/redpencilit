<template>
    <div class="w-full">
        <button v-if="!testimonial"
                class="inline-flex items-center bg-blue-lightest text-blue-dark text-xs px-4 py-2 rounded-full"
                @click="showTestimonial">
            <i class="las la-plus ml-2"></i>
            {{ trans.get('__JSON__.add to home page') }}
        </button>


        <div class="w-full" v-if="testimonial">
            <label class="font-bold text-grey-dark text-sm mb-2 block" for="body">
                {{ trans.get('__JSON__.message body') }}
            </label>

            <textarea name="body" id="body"
                      @keydown="errors.clear('body')"
                      v-model="body"
                      class="leading-normal text-sm text-grey-darker border border-transparent focus:border-indigo focus:outline-none w-full bg-grey-lighter rounded px-4 py-2 h-24 mb-2"></textarea>

            <div class="feedback feedback--invalid mb-4" v-if="errors.has('body')">
                {{ errors.get('body') }}
            </div>

            <div class="flex items-center">
                <button
                        class="mb-4 inline-flex items-center bg-indigo-lightest text-indigo text-sm px-4 py-2 rounded-full"
                        @click="saveTestimonialOn(comment)">
                    <i class="la la-save text-lg ml-1"></i>
                    {{ trans.get('__JSON__.save message') }}
                </button>

                <button
                        class="inline-flex items-center bg-red-lightest text-red text-xs px-1 py-1 rounded-full"
                        :class="[locale === 'fa' ? 'mr-auto' : 'ml-auto']"
                        @click="hideTestimonial">
                    <i class="la la-times"></i>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import Errors from "../Errors";

    export default {
        name: "Testimonial",

        props: ['comment'],

        created() {
            this.body = this.comment.message
        },

        data() {
            return {
                testimonial: false,
                body: '',
                errors: new Errors(),
                locale: Redpencilit.locale
            }
        },

        methods: {
            showTestimonial() {
                this.testimonial = true;
            },

            hideTestimonial() {
                this.testimonial = false;
            },

            saveTestimonialOn(comment) {
                let url = `/${this.locale}/comments/${comment.id}/testimonials`;

                axios.post(url, {
                    body: this.body
                }).then(response => {
                    if (response.status == 200) {
                        flash(response.data);

                        this.testimonial = false;
                    }
                }).catch(error => {
                    this.errors.record(error.response.data.errors);
                });
            }
        }
    }
</script>

