<template>


</template>

<script>
    import Errors from "../Errors";

    export default {
        props: [
            'setting',
        ],

        mounted() {
            localStorage.clear('setting');
        },

        created() {
            this.reset();
        },

        data() {
            return {
                showEdit: false,
                errors: new Errors(),
                formSetting: {}
            }
        },

        methods: {
            onEdit() {
                this.showEdit = true;
            },

            onCancelEdit() {
                this.showEdit = false;
                this.errors.clear();
                this.reset();
            },

            reset() {
                if (localStorage.hasOwnProperty('setting')) {
                    this.formSetting = JSON.parse(localStorage.getItem('setting'));
                    return;
                }

                if (this.setting) {
                    this.formSetting = this.setting;

                    return;
                }

                this.formSetting = {
                    upload_articles_per_day: '',
                    base_price_for_docs: '',
                    price_per_word: '',
                    upload_words_per_day: ''
                };
            },

            submit() {
                axios[this.method()](this.uri(), this.formSetting).then(response => {
                    flash('اطلاعات با موفقیت به روز رسانی شد.');
                    localStorage.setItem('setting', JSON.stringify(response.data));

                    this.formSetting = response.data;
                    this.showEdit = false;
                }).catch(error => {
                    flash('به روز رسانی انجام نشد!', 'danger');

                    this.errors.record(error.response.data.errors);
                });
            },

            uri() {
                if (localStorage.hasOwnProperty('setting'))    {
                    return '/settings/' +  JSON.parse(localStorage.getItem('setting')).id;
                }

                if (this.setting) {
                    return '/settings/' + this.setting.id;
                }

                return '/settings';
            },

            method() {
                if (localStorage.hasOwnProperty('setting') || this.setting)    {
                    return 'patch';
                }

               return 'post' ;
            },

            resetError(event) {
                this.errors.reset(event.target.name);
            },
        }
    }
</script>