<template>
    <div class="container">
        <div class="upload-levels">
            <h3 class="upload-levels__title">آپلود مستندات</h3>

            <ul class="upload-levels__list" :class="{'half' : step === 2, 'full': step === 3}">
                <li class="upload-levels__item" :class="{'upload-levels__item--active' : (step === 1), 'filled' :
                (step > 1)}">
                    <span class="upload-levels__marker"></span>

                    <div class="upload-levels__content">
                        <span>مرحله ۱</span>
                        ثبت نام
                    </div>
                </li>

                <li class="upload-levels__item" :class="{'upload-levels__item--active': (step === 2), 'show-anime':
                (step === 2), 'filled' : (step > 2)}">
                    <span class="upload-levels__marker"></span>

                    <div class="upload-levels__content">
                        <span>مرحله ۲</span>
                        آپلود مستندات
                    </div>
                </li>

                <li class="upload-levels__item" :class="{'upload-levels__item--active': step === 3, 'show-anime':
                step === 3}">
                    <span class="upload-levels__marker"></span>

                    <div class="upload-levels__content">
                        <span>مرحله ۳</span>
                        نهایی کردن اطلاعات
                    </div>
                </li>
            </ul>
        </div><!-- upload-levels -->


        <Modal v-if="modal" @closeModal="modal = false">
            <p class="text-grey-dark">
                با انتخاب گزینه انصراف کلیه فایل‌های آپلود شده حذف می‌گردد. آیا از انتخاب خود مطمئنید؟
            </p>

            <template #footer>
                <div class="flex items-center">
                    <a class="button button--simple button--sm" href="#" @click.prevent="modal = false">پشیمان شدم. حذف
                        نکن :)</a>

                    <button class="button button--sm button--outline--danger mr-auto z-50" @click.prevent="cancelIt">بله
                        مطمئنم.
                        حذف
                        کن!
                    </button>
                </div>
            </template>
        </Modal>

        <div class="upload-sections">
            <!--=================================================================
             STEP 1
            -=================================================================-->
            <div class="upload-section" v-if="step === 1" v-cloak>
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

            <!--=================================================================
             STEP 2
            -=================================================================-->
            <div class="upload-section" v-if="step === 2" v-cloak>
                <uploader-file class="mb-12" @fileUploaded="generateSettings" :user="user"
                               :token="token"></uploader-file>

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

                            <p class="form-excerpt" v-show="contract">برای کتاب، محاسبه قیمت و زمان به صورت توافقی
                                می‌باشد. لطفا در مرحله‌ بعد آدرس ایمیل و شماره
                                تماس خود را وارد کنید تا در اسرع وقت برای هماهنگی‌های لازم با شما ارتباط برقرار شود.
                                پبشاپیش از شکیبایی شما متشکریم.</p>
                        </div><!-- .mb-3 -->

                        <div class="flex items-center p-4 text-sm bg-white shadow mb-1" v-show="!contract"
                             :class="classObject">
                            <span>تاریخ تحویل (تخمینی)</span>
                            <span class="mr-auto tag tag--info" v-if="deliverDate">
                                {{ persianNumber.toPersian(deliverDate) }}
                            </span>
                        </div>

                        <p class="form-excerpt mb-6" v-show="deliverDate">اگر زمان مورد نظر فراتر از انتظار شماست،
                            می‌توانید جهت هماهنگی، با پشتیبانی تماس حاصل فرمایید.</p>


                        <div class="flex shadow p-4 mb-6 text-sm bg-white items-center" v-show="!contract">
                            <span>تعداد کلمات مقاله (ها)</span>

                            <span class="mr-auto tag tag--info" v-show="words">
                                {{ persianNumber.toPersian(words) + ' کلمه' }}
                            </span>
                        </div>
                    </div><!-- w-3/5 -->
                </div><!-- w-3/4 -->

                <div class="w-1/3 bg-white rounded shadow mx-auto p-6" v-if="priceIsAvailable">
                    <p class="text-red border-b border-red pb-3 mb-12">مبلغ محاسبه شده</p>


                    <div class="text-center">
                        <h3 class="text-3xl mb-6">
                            <span v-show="!contract">{{ persianNumber.toPersian(price) }} تومان</span>
                            <span v-show="contract">توافقی</span>
                        </h3>

                        <button class="button button--primary mb-3" @click="saveSecondStep">مرحله بعد</button>
                        <p class="mb-6">
                            <a class="text-grey-dark text-sm no-underline"
                               @click.prevent="requestToCancel">
                                انصراف
                            </a>
                        </p>
                    </div><!-- text-center -->
                </div><!-- w-1/3 -->
            </div><!-- upload-section -->

            <!--=================================================================
             STEP 3
            -=================================================================-->
            <div class="upload-section" v-if="step === 3" v-cloak>
                <div class="w-3/4 mx-auto bg-white pt-6 pb-3 mb-12">
                    <div class="text-center">
                        <img class="w-1/3" src="/images/checkmark.svg" alt="checkmark icon">
                    </div>

                    <div class="flex">
                        <section class="px-6 w-1/3 text-center border-l border-grey-lighter">
                            <img class="mb-3 h-24" src="/images/uploaded-articles.svg"
                                 alt="vector two people and monitor">

                            <h3 class="text-grey-dark mb-3">تعداد فایل‌های آپلود شده</h3>

                            <div class="list">
                              <li>{{ persianNumber.toPersian(this.order.details.length) }} فایل</li>
                            </div>
                        </section>

                        <section class="px-6 w-1/3 text-center border-l border-grey-lighter">
                            <img class="mb-3 h-24" src="/images/selected-services.svg"
                                 alt="vector girl and rounded icons">

                            <h3 class="text-grey-dark mb-3">سرویس‌های انتخاب شده</h3>

                            <ul class="list">
                                <li v-text="service(selected)"></li>
                                <li>تاریخ تحویل: {{  persianNumber.toPersian(deliverDate) }}</li>
                            </ul>
                        </section>

                        <section class="px-6 w-1/3 text-center">
                            <img class="mb-3 h-24" src="/images/price.svg" alt="vector payment cart">

                            <h3 class="text-grey-dark mb-3">هزینه قابل پرداخت</h3>

                            <ul class="list">
                                <li>{{ persianNumber.toPersian(words) }} کلمه</li>
                                <li>{{ persianNumber.toPersian(price) }} تومان</li>
                            </ul>
                        </section>
                    </div>
                </div>

                <div class="w-3/4 mx-auto flex mb-12" style="min-height: 240px;">
                    <div class="title-custom-bg w-2/5">
                        <h3 class="w-1/2 leading-normal pt-24">تایید نهایی و پرداخت</h3>
                    </div>

                    <div class="w-3/5 flex items-center justify-center">
                        <div class="text-center w-1/2">
                            <a href="#" class="button button--primary button--block mb-6">
                                پرداخت
                                <i class="fas fa-arrow-left mr-3"></i>
                            </a>

                            <a href="#" @click="requestToCancel" class="no-underline text-gery">انصراف</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import UploaderFile from '../components/UploaderFile.vue';
    import Tab from '../components/Tab.vue';
    import UploadRegisterForm from '../components/UploadRegisterForm.vue';
    import UploadLoginForm from '../components/UploadLoginForm';
    import moment from 'jalali-moment';
    import PersianNumber from "../PersianNumber.js";
    import Modal from "../components/Modal";

    export default {
        props: ['services'],

        components: {
            UploaderFile,
            Tab,
            UploadRegisterForm,
            UploadLoginForm,
            Modal
        },

        computed: {
            classObject() {
                return {
                    'mb-6': !this.deliverDate
                }
            },

            priceIsAvailable() {
                return this.selected && this.words;
            },
        },

        mounted() {
            this.options = this.services;
            this.step = window.Redpencilit.signed ? 2 : 1;
            this.user = window.Redpencilit.user ? window.Redpencilit.user : null;
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
                token: null,
                step: 1,
                price: 0,
                persianNumber: new PersianNumber(),
                modal: false,
                order: null,
                documents: []
            }
        },

        methods: {
            generateSettings(order) {
                this.order = order;
                this.words = this.order.total_words;
                this.price = this.order.price;

                const m = moment(order.delivery_date);
                m.locale('fa');

                this.deliverDate = m.format('DD') + ' ' + m.format('MMMM') + ' ' + m.format('YYYY');
            },

            onSelect() {
                let service = Array.from(this.services).find(service => service.id === this.selected);

                this.contract = service.negotiable;
            },

            completeAuth(data) {
                this.login = true;
                this.user = data.user;
                this.token = data.token;
                this.step = 2;

                window.axios.defaults.headers.common = {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': data.token
                };
            },

            requestToCancel() {
                this.modal = true;
            },

            cancelIt() {
                axios.delete(`/users/${this.user.username}/orders/${this.order.id}`)
                    .then(response => {
                        if (response.data.status === 200) {
                            window.location.reload();
                        }
                    }).catch(error => {
                    flash('با عرض پوزش سیستم با خطا مواجه شد. لطفا دوباره سعی کنید.', 'danger');
                });
            },

            service(selected) {
                for (let item of this.services) {
                    if (item.id === parseInt(selected)) {
                        return item.name;
                    }
                }
            },

            saveSecondStep() {
                let formData = new FormData;

                formData.append('service', this.service);

                axios.post(`/users/${this.user.username}/drafts`, {
                    'service_id': this.selected,
                    'order_id': this.order.id
                })
                    .then(res => {
                        if (res.status === 200) {
                            flash('مرحله دوم با موفقیت به اتمام رسید.ِ')
                        }
                        this.step++;
                    }).catch(error => {
                    flash('متاسفانه مشکلی در ذخیره سازی اطلاعات پیش‌ آمد. لطفا مجددا سعی کنید.', 'danger');
                    return;
                });
            }
        },
    }
</script>
