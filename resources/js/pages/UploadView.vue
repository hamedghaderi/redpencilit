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

        <div class="w-3/4 mx-auto flex" style="min-height: 240px;">
            <div class="title-custom-bg w-2/5">
                <h3 class="w-1/2 leading-normal pt-24">سرویس مورد نظر خود را انتخاب کنید</h3>
            </div>

            <div class="w-3/5">
                <div class="mb-6">
                    <div class="select mb-6">
                        <select name="service" id="service" @change="onSelect" v-model="selected">
                            <option value="">لطفا سرویس مورد نظر خود را انتخاب کنید</option>
                            <option v-for="service in options" v-bind:value="service.id">
                                {{ service.name }}
                            </option>
                        </select>
                    </div>
                    <p class="form-excerpt" v-show="contract">برای کتاب، محاسبه قیمت و زمان به صورت توافقی می‌باشد. لطفا
                        در مرحله‌ بعد
                        آدرس ایمیل و
                        شماره
                        تماس خود را وارد کنید تا در اسرع وقت برای هماهنگی‌های لازم با شما ارتباط برقرار شود. پبشاپیش
                    از شکیبایی شما متشکریم.</p>
                </div>

                <div class="mb-8">
                    <div class="select" v-show="!contract">
                      <p-date-picker input-class="date-picker"
                                     header-color="#3d4852"
                                     header-background-color="transparent"
                                     hover-day-back-color="#b2b7ff"
                                     chosen-day-back-color="#5A5DFF"
                                     name="deliveryDate"
                                     :disableDatesBeforeToday="true"
                                     :available-dates="true"
                                     @input="onInputChange"
                                     open-transition-animation="left-slide-fade"
                                    placeholder="تاریخ تحویل: روز / ماه / سال"></p-date-picker>

                    </div>
                </div>

                <div class="flex shadow p-4 mb-6 text-sm bg-white" v-show="!contract">
                    <span>تعداد کلمات مقاله (ها)</span>
                    <span class="mr-auto tag tag--info" v-show="words">
                        {{ words + ' کلمه' }}
                    </span>
                </div>
            </div>
        </div>
    </div><!-- container -->
</template>

<script>
    import UploaderFile from '../components/UploaderFile.vue';
    import PDatePicker from 'vue2-persian-datepicker';

    export default {
        props: ['services'],

        components: {
            UploaderFile,
            PDatePicker
        },


        created() {
         this.options = JSON.parse(this.services);
        },


        data() {
            return {
                selected: '',
                words: 0,
                options: null,
                contract: false,
            }
        },

        methods: {
            setWords(words) {
                this.words = words;
            },

            onSelect() {
                if (this.selected == 1) {
                    this.contract = true;
                } else {
                    this.contract = false;
                }
            },

            onInputChange(e) {
                console.log(e);
            }
        },
    }
</script>