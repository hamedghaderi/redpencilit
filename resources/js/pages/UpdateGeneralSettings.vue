<template>
    <div>
        <div class="flex items-center border-b border-grey-lighter pb-3 mb-3">
            <h3>تنظیمات</h3>

            <button
                    type="button"
                    class="mr-auto button button--smooth--primary button--sm"
                    @click="onEdit"
                    v-show="!showEdit">
                ویرایش اطلاعات
            </button>

            <button type="button"
                    class="mr-auto button button--smooth--danger button--sm"
                    @click="onCancelEdit"
                    v-show="showEdit">
                منصرف شدم!
            </button>
        </div>

        <form @submit.prevent @keydown="resetError">
            <div class="flex mb-12">
                <div class="w-1/3" :class="{ 'form-group': showEdit, 'pl-6': showEdit }">
                    <label for="upload_articles_per_day" class="text-grey block mb-4">حداکثر تعداد آپلود مقاله در
                        روز</label>
                    <input
                            class="w-full"
                            type="text"
                            :value="formSetting.upload_articles_per_day"
                            @input="sanitizeNumber"
                            name="upload_articles_per_day"
                            :readonly="!showEdit"
                            :class="{ 'dashboard-input': showEdit }"
                    >

                    <p class="feedback feedback--invalid my-2" v-if="errors.has('upload_articles_per_day')">
                        {{ this.errors.get('upload_articles_per_day') }}
                    </p>
                </div>

                <div class="w-1/3" :class="{ 'form-group': showEdit, 'pl-6': showEdit }">
                    <label for="upload_words_per_day" class="text-grey block mb-4">حداکثر تعداد کلمات قابل پذیرش در
                        روز</label>
                    <input
                            class="w-full"
                            type="text"
                            :value="formSetting.upload_words_per_day"
                            @input="sanitizeNumber"
                            name="upload_words_per_day"
                            :readonly="!showEdit"
                            :class="{ 'dashboard-input': showEdit }">
                    <p class="feedback feedback--invalid my-2" v-if="errors.has('upload_words_per_day')">
                        {{ this.errors.get('upload_words_per_day') }}
                    </p>
                </div>

                <div class="w-1/3" :class="{ 'form-group': showEdit, 'pl-6': showEdit }">
                    <label for="price_per_word" class="text-grey block mb-4">قیمت هر کلمه در واحد تومان</label>
                    <input
                            class="w-full"
                            type="text"
                            :value="formSetting.price_per_word"
                            @input="sanitizeNumber"
                            name="price_per_word"
                            :readonly="!showEdit"
                            :class="{ 'dashboard-input': showEdit }">
                    <p class="feedback feedback--invalid my-2" v-if="errors.has('price_per_word')">
                        {{ this.errors.get('price_per_word') }}
                    </p>
                </div>
            </div>

            <div class="flex">
                <div class="w-1/3" :class="{ 'form-group': showEdit, 'pl-6': showEdit }">
                    <label for="base_price_for_docs" class="text-grey block mb-4">قیمت پایه برای فایل‌های کم حجم
                        (تومان)</label>
                    <input
                            class="w-full"
                            type="text"
                            :value="formSetting.base_price_for_docs"
                            @input="sanitizeNumber"
                            name="base_price_for_docs"
                            :readonly="!showEdit"
                            :class="{ 'dashboard-input': showEdit }">

                    <p class="feedback feedback--invalid my-2" v-if="errors.has('base_price_for_docs')">
                        {{ this.errors.get('base_price_for_docs') }}
                    </p>
                </div>

                <div class="w-2/3 text-left self-center" v-show="showEdit">
                    <button class="button button--primary" @click="submit">ذخیره تنظیمات</button>
                </div>
            </div>
        </form>
    </div>

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