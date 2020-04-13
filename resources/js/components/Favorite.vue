<template>
    <div class="flex items-center">
        <p class="text-sm text-grey-darker" v-if="!favorited">
            {{ trans.get(`__JSON__.If you've liked the post, please make us happy by clicking on favorite icon.`) }}
        </p>

        <p class="text-sm text-grey-darker" v-else>{{ trans.get(`__JSON__.You've liked this post`)}}</p>

        <span class="cursor-pointer" :class="{'mr-auto' : locale === 'fa', 'ml-auto' : locale === 'en'}">
            <span class="text-grey-dark">{{ count }}</span>
            <i class="la la-heart text-grey-dark" v-if="!favorited" @click="favorite"></i>
            <i class="la la-heart text-red" v-else @click="disfavor"></i>
        </span>
    </div>
</template>

<script>
    export default {
        props: ['post'],

        created() {
            this.favorited = this.post.isFavorited;
            this.count = this.post.favorites_count;
        },

        data() {
            return {
                favorited: false,
                locale: Redpencilit.locale,
                count: 0,
            }
        },
        methods: {
            favorite() {
                let url = `/${this.locale}/posts/${this.post.id}/favorite`;

                axios.post(url).then(res => {
                    this.count++;
                    flash(this.trans.get('__JSON__.😍 I liked the post'));

                    this.favorited = true;
                }).catch(error => {
                    flash(this.trans.get(`__JSON__.Liking process failed. Please try again`), 'danger');
                })
            },

            disfavor() {
                this.count--;
                let url = `/${this.locale}/posts/${this.post.id}/disfavor`;

                axios.delete(url).then(res => {
                    flash(this.trans.get(`__JSON__.I get back my decision. ☹️`));

                    this.favorited = false;
                }).catch(error => {
                    flash(
                        this.trans.get(`__JSON__.Unfortunately, the unliking process failed. Please try again`),
                        'danger'
                    );
                })
            }
        }
    }
</script>

<style>
</style>
