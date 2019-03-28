<template>
    <div class="container">
        <div class="upload-levels">
            <h3 class="upload-levels__title">آپلود مستندات</h3>

            <ul class="upload-levels__list">
                <li class="upload-levels__item upload-levels__item--active">
                    <span class="upload-levels__marker"></span>

                    <div class="upload-levels__content">
                        <span>مرحله ۱</span>
                        آپلود مستندات
                    </div>
                </li>
                <li class="upload-levels__item">
                    <span class="upload-levels__marker"></span>

                    <div class="upload-levels__content">
                        <span>مرحله ۲</span>
                        ثبت نام
                    </div>
                </li>
                <li class="upload-levels__item">
                    <span class="upload-levels__marker"></span>

                    <div class="upload-levels__content">
                        <span>مرحله ۳</span>
                        نهایی کردن اطلاعات
                    </div>
                </li>
            </ul>
        </div><!-- upload-levels -->


        <uploader-file class="mb-12" @fileUploaded="setWords"></uploader-file>

        <div class="w-3/4 mx-auto flex">
            <h3 class="w-2/5">سرویس مورد نظر خود را انتخاب کنید</h3>

            <div class="w-3/5">
                <div class="flex shadow p-5 mb-6 text-sm">
                    <span>تعداد کلمات مقاله (ها)</span>
                    <span class="mr-auto tag tag--info" v-show="words">
                        {{ words + ' کلمه' }}
                    </span>
                </div>

                <div class="mb-6">
                    <select name="service" id="service">
                        <option value="">لطفا سرویس مورد نظر خود را انتخاب کنید</option>
                        <!--<option v-for="service in services" value="service.id">service.name</option>-->
                        <option v-for="service in allServices" :value="service.id">
                            {{ service.name }}
                        </option>
                    </select>
                </div>

                <div class="mb-6">
                    <input type="text" name="delivery-date" placeholder="تاریخ تحویل">
                </div>
            </div>
        </div>
    </div><!-- container -->
</template>

<script>
    import UploaderFile from '../components/UploaderFile.vue';

    export default {
        props: ['services'],

        components: {UploaderFile},

        created() {
         this.allServices = JSON.parse(this.services);
        },


        data() {
            return {
                words: 0,
                allServices: null,
            }
        },

        methods: {
            setWords(words) {
                this.words = words;
            }
        }
    }
</script>