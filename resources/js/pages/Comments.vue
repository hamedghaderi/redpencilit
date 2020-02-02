<template>
    <div class="mb-8">
        <div class="row px-6 mb-4 hidden lg:flex">
            <div class="w-1/5 text-sm text-grey-dark">{{ trans.get('__JSON__.message sender')}}</div>
            <div class="w-2/5 text-sm text-grey-dark">{{ trans.get('__JSON__.sender email') }}</div>
            <div class="w-1/5 text-sm text-grey-dark">{{ trans.get('__JSON__.sent at') }}</div>
            <div class="w-1/5 text-sm text-grey-dark">{{ trans.get('__JSON__.score') }}</div>
        </div>

        <div class="bg-white mb-4 px-6 py-4 shadow hover:shadow-lg flex flex-wrap items-center relative rounded"
             v-for="comment in comments">

            <div class="w-full mb-1 lg:mb-0 lg:w-1/5 text-grey-darker text-sm font-bold">
                {{ comment.name }}
            </div>

            <div class="w-full mb-4 lg:mb-0 lg:w-2/5 text-grey lg:text-grey-darker text-xs lg:text-sm">
                {{ comment.email }}
            </div>

            <div class="w-full mb-4 lg:mb-0 lg:w-1/5 text-grey-darker text-sm"
                 v-text="dateTime(comment.created_at)"></div>

            <div class="w-full lg:w-1/5 mb-4 lg:mb-0 text-grey-darker text-sm flex">
                <span class="text-yellow-dark mr-1" v-for="i in 5">
                    <i class="fa-star" :class="{'fas': comment.rate >= i, 'far': comment.rate < i}"></i>
                </span>

                <div class="mr-auto">
                    <span class="bg-red-lightest text-red-dark text-xs px-2 py-1 rounded hover:bg-red-dark hover:text-white hover:cursor-pointer"
                          @click="deleteComment(comment)">{{ trans.get('__JSON__.delete') }} </span>
                </div>
            </div>

            <div class="w-full border-t border-grey-light text-sm text-grey-dark pt-3 mt-3 mb-4">
                <p class="mb-4">{{ comment.message }}</p>
            </div>

            <testimonial :comment="comment"></testimonial>
        </div>
    </div>
</template>

<script>
    import moment from 'jalali-moment';
    import Testimonial from "../components/Testimonial";

    export default {
        props: ['collection'],

        components: {Testimonial},

        created() {
            this.comments = this.collection['data'];
        },

        data() {
            return {
                comments: [],
                locale: Redpencilit.locale
            }
        },

        methods: {
            dateTime(date) {
                const m = moment(date);
                m.locale(this.locale);

                return m.format('DD') + ' ' + m.format('MMMM') + ' ' + m.format('YYYY');
            },

            hasRate(rate) {
                return parseInt(rate);
            },

            deleteComment(comment) {
                let url = `/${this.locale}/comments/${comment.id}`;

                axios.delete(url).then(response => {
                    if (response.status == 200) {
                        this.comments = this.comments.filter(function (comment) {
                            return comment.id != cm.id;
                        });

                        flash('پیام با موفقیت حذف شد.');
                    }
                }).catch(error => {
                    flash('حذف پیام با مشکل مواجه شد. لطفا مجددا سعی کنید.', 'danger');
                });
            },
        }
    }
</script>

<style scoped>

</style>