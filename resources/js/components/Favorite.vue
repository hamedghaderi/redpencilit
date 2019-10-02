<template>
    <div class="flex items-center">
        <p class="text-sm text-grey-darker" v-if="!favorited">در صورتیکه از این پست خوشتان آمده لطفا آن را لایک کنید
            .</p>
        <p class="text-sm text-grey-darker" v-else>شما این پست را پسندیده‌اید.</p>
        <span class="mr-auto cursor-pointer">
            <i class="far fa-heart text-grey-dark" v-if="!favorited" @click="favorite"></i>
            <i class="fas fa-heart text-red" v-else @click="disfavor"></i>
        </span>
    </div>
</template>

<script>
    export default {
        props: ['post'],

        created() {
            this.favorited = this.post.isFavorited;
        },

        data() {
            return {
                favorited: false,
            }
        },
        methods: {
            favorite() {
                let url = `/posts/${this.post.id}/favorite`;

                axios.post(url).then(res => {
                    flash('پست را پسندیدم!');
                    this.favorited = true;
                }).catch(error => {
                    flash('لایک شما ثبت نشد. لطفا مجددا سعی کنید.!', 'danger');
                })
            },

            disfavor() {
                let url = `/posts/${this.post.id}/disfavor`;

                axios.delete(url).then(res => {
                    flash('پشیمان شدم :(!');

                    this.favorited = false;
                }).catch(error => {
                    flash('متاسفانه عملیات با موفقیت ثبت نشد. لطفا مجددا سعی کنید.', 'danger');
                })
            }
        }
    }
</script>

<style>
</style>