<template>
    <div class="container">
        <div class="upload-levels">
            <h3 class="upload-levels__title">آپلود مستندات</h3>

            <ul class="upload-levels__list" :class="{'half' : login}">
                <li class="upload-levels__item" :class="{'upload-levels__item--active' : !login, 'filled' : login}">
                    <span class="upload-levels__marker"></span>

                    <div class="upload-levels__content">
                        <span>مرحله ۱</span>
                        ثبت نام
                    </div>
                </li>

                <li class="upload-levels__item" :class="{'upload-levels__item--active': login, 'show-anime': login}">
                    <span class="upload-levels__marker"></span>

                    <div class="upload-levels__content">
                        <span>مرحله ۲</span>
                        آپلود مستندات
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


        <div class="upload-sections">
            <div class="upload-section" v-if="!login">
                <div class="flex w-3/4 mx-auto">
                    <div class="w-1/2">
                      <div class="tabs">
                          <div class="tab-header">
                              <div class="tab-pane" :class="{'tab-pane--active' : registerActive}">
                                 <span class="tab-name">
                                    <a href="#" @click.prevent="registerActive = true">ثبت‌نام</a>
                                 </span>
                              </div>

                              <div class="tab-pane" :class="{'tab-pane--active' : !registerActive}">
                                 <span class="tab-name">
                                    <a href="#" @click.prevent="registerActive = false">ورود به حساب</a>
                                 </span>
                              </div>
                          </div>

                          <div class="tab-content" v-show="registerActive">
                              <upload-register-form @userRegistered="completeAuth"></upload-register-form>
                          </div><!-- tab-content -->

                          <div class="tab-content" v-show="!registerActive">
                            <upload-login-form @userLoggedIn="completeAuth"></upload-login-form>
                          </div><!-- .tab-content -->
                      </div>
                    </div>

                    <div class="w-1/2 text-left">
                        <img src="/images/upload-register.svg" alt="upload-register" class="w-full">
                    </div>
                </div>
            </div><!-- upload-section -->

            <div class="upload-section" v-if="login">
                <uploader-file class="mb-12" @fileUploaded="setWords"></uploader-file>

                <div class="w-3/4 mx-auto flex mb-12" style="min-height: 240px;">
                    <div class="title-custom-bg w-2/5">
                        <h3 class="w-1/2 leading-normal pt-24">سرویس مورد نظر خود را انتخاب کنید</h3>
                    </div>

                    <div class="w-3/5">
                        <div class="mb-3">
                            <div class="select">
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

                        <div class="flex items-center p-4 text-sm bg-white shadow mb-1" v-show="!contract" :class="classObject">
                            <span>تاریخ تحویل (تخمینی)</span>
                            <span class="mr-auto tag tag--info" v-if="deliverDate">
                        {{ deliverDate }}
                    </span>
                        </div>
                        <p class="form-excerpt mb-6" v-show="deliverDate""">اگر زمان مورد نظر فراتر از انتظار شماست، می‌توانید
                        جهت
                        هماهنگی، با
                        پشتیبانی
                        تماس حاصل فرمایید.</p>

                        <div class="flex shadow p-4 mb-6 text-sm bg-white items-center" v-show="!contract">
                            <span>تعداد کلمات مقاله (ها)</span>
                            <span class="mr-auto tag tag--info" v-show="words">
                        {{ words + ' کلمه' }}
                    </span>
                        </div>
                    </div>
                </div>

                <div class="w-1/3 bg-white rounded shadow mx-auto p-6">
                    <p class="text-red border-b border-red pb-3 mb-12">مبلغ محاسبه شده</p>


                    <div class="text-center">
                        <h3 class="text-3xl mb-6">
                            <span v-show="!contract"> ۳۰۰٬۰۰۰ تومان</span>
                            <span v-show="contract">توافقی</span>
                        </h3>

                        <button class="button button--primary mb-3">مرحله بعد</button>
                        <p class="mb-6"><a class="text-grey-dark text-sm no-underline" href="#">انصراف</a></p>
                    </div>
                </div>
            </div><!-- upload-section -->
        </div>
    </div><!-- container -->
</template>

<script>
    import UploaderFile from '../components/UploaderFile.vue';
    import Tab from '../components/Tab.vue';
    import UploadRegisterForm from '../components/UploadRegisterForm.vue';
    import UploadLoginForm from '../components/UploadLoginForm';
    import moment from 'jalali-moment';


    export default {
        props: ['services'],

        components: {
            UploaderFile,
            Tab,
            UploadRegisterForm,
            UploadLoginForm
        },

        computed: {
            classObject() {
                return {
                    'mb-6': !this.deliverDate
                }
            },
        },


        created() {
            this.options = JSON.parse(this.services);
            this.login = window.Redpencilit.signed;
        },

        data() {
            return {
                selected: '',
                words: 0,
                options: null,
                contract: false,
                deliverDate: null,
                registerActive: true,
                user: null,
                login: false,
            }
        },

        methods: {
            setWords(data) {
                const m = moment(data.date_available);
                m.locale('fa');
                this.words = data.words;
               this.deliverDate = m.format('DD') + ' ' + m.format('MMMM') + ' ' + m.format('YYYY');
            },

            onSelect() {
                if (this.selected == 1) {
                    this.contract = true;
                } else {
                    this.contract = false;
                }
            },

            completeAuth(user) {
                this.login = true;
                this.user = user;
            }
        },
    }
</script>

<style>

</style>