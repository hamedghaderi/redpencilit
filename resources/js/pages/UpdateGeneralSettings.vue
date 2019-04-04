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

        <div class="flex mb-12">
            <div class="w-1/3" :class="{ 'form-group': showEdit, 'pl-6': showEdit }">
                <label for="upload_articles_per_day" class="text-grey block mb-4">حداکثر تعداد آپلود مقاله در
                    روز</label>
                <input
                    class="w-full"
                    type="text"
                    :value="upload_articles_per_day"
                    name="upload_articles_per_day"
                    :readonly="!showEdit"
                    :class="{ 'dashboard-input': showEdit }">
            </div>

            <div class="w-1/3" :class="{ 'form-group': showEdit, 'pl-6': showEdit }">
                <label for="upload_words_per_day" class="text-grey block mb-4">حداکثر تعداد کلمات قابل پذیرش در
                    روز</label>
                <input
                        class="w-full"
                        type="text"
                        :value="upload_words_per_day"
                        name="upload_words_per_day"
                        :readonly="!showEdit"
                        :class="{ 'dashboard-input': showEdit }">
            </div>

            <div class="w-1/3" :class="{ 'form-group': showEdit, 'pl-6': showEdit }">
                <label for="price_per_word" class="text-grey block mb-4">قیمت هر کلمه در واحد تومان</label>
                <input
                        class="w-full"
                        type="text"
                        :value="price_per_word"
                        name="price_per_word"
                        :readonly="!showEdit"
                        :class="{ 'dashboard-input': showEdit }">
            </div>
        </div>

        <div class="flex">
            <div class="w-1/3" :class="{ 'form-group': showEdit, 'pl-6': showEdit }">
                <label for="base_price_for_docs" class="text-grey block mb-4">قیمت پایه برای فایل‌های کم حجم
                    (تومان)</label>
                <input
                        class="w-full"
                        type="text"
                        :value="base_price_for_docs"
                        name="base_price_for_docs"
                        :readonly="!showEdit"
                        :class="{ 'dashboard-input': showEdit }">
            </div>

            <div class="w-2/3 text-left self-center" v-show="showEdit">
                <button type="submit" class="button button--primary">ذخیره تنظیمات</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'upload_articles_per_day',
            'upload_words_per_day',
            'price_per_word',
            'base_price_for_docs'
        ],

        data() {
            return {
                showEdit: false,
            }
        },

        methods: {
            onEdit() {
                this.showEdit = true;
            },

           onCancelEdit() {
                this.showEdit = false;
           }
        }
    }
</script>