<template>
    <div class="w-full">
        <button
                v-if="!testimonial"
                class="inline-flex items-center bg-blue-lightest text-blue-dark text-xs px-4 py-2 rounded-full"
                @click="showTestimonial">
            <svg class="fill-current h-4 w-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                 width="24"
                 height="24">
                <path
                        class="heroicon-ui"
                        d="M17 11a1 1 0 0 1 0 2h-4v4a1 1 0 0 1-2 0v-4H7a1 1 0 0 1 0-2h4V7a1 1 0 0 1 2 0v4h4z"/>
            </svg>
            افزودن به صفحه اصلی
        </button>


        <div class="w-full" v-if="testimonial">
            <label class="font-bold text-grey-dark text-sm mb-2 block" for="body">متن پیام</label>

            <textarea name="body" id="body"
                      @keydown="errors.clear('body')"
                      v-model="body"
                      class="leading-normal text-sm text-grey-darker border border-transparent focus:border-indigo focus:outline-none w-full bg-grey-lighter rounded px-4 py-2 h-24 mb-2"></textarea>

            <div class="feedback feedback--invalid mb-4" v-if="errors.has('body')">
                {{ errors.get('body') }}
            </div>

            <div class="flex items-center">
                <button
                        class="mb-4 inline-flex items-center bg-indigo-lightest text-indigo text-xs px-4 py-2 rounded-full"
                        @click="saveTestimonialOn(comment)">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                         width="24" height="24">
                        <path
                                class="heroicon-ui"
                                d="M13 5.41V17a1 1 0 0 1-2 0V5.41l-3.3 3.3a1 1 0 0 1-1.4-1.42l5-5a1 1 0 0 1 1.4 0l5 5a1 1 0 1 1-1.4 1.42L13 5.4zM3 17a1 1 0 0 1 2 0v3h14v-3a1 1 0 0 1 2 0v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-3z"/>
                    </svg>
                    ذخیره پیام
                </button>

                <button
                        class="mr-auto inline-flex items-center bg-red-lightest text-red text-xs px-1 py-1 rounded-full"
                        @click="hideTestimonial">
                    <svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                         width="24"
                         height="24">
                        <path
                                class="heroicon-ui"
                                d="M16.24 14.83a1 1 0 0 1-1.41 1.41L12 13.41l-2.83 2.83a1 1 0 0 1-1.41-1.41L10.59 12 7.76 9.17a1 1 0 0 1 1.41-1.41L12 10.59l2.83-2.83a1 1 0 0 1 1.41 1.41L13.41 12l2.83 2.83z"/>
                    </svg>
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
                let url = '/comments/' + comment.id + '/testimonials';

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

<style scoped>

</style>