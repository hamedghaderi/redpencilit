<template>
    <div class="w-full px-4 md:px-24 mt-12">
        <progress-level :step="step"></progress-level>

        <Modal v-if="modal" @closeModal="modal = false">
            <p class="text-grey-dark">
                {{ trans.get(`__JSON__.By choosing this, all uploaded files will be deleted. Are you sure, wanna do this?`)}}
            </p>

            <template #footer>
                <div class="flex items-center">
                    <a class="button button--simple button--sm" href="#" @click.prevent="modal = false">
                        {{ trans.get('__JSON__.No Nooo! Just continue!')}}
                    </a>

                    <button class="button button--sm button--outline--danger mr-auto z-50"
                            @click.prevent="cancelIt">
                        {{ trans.get('__JSON__.Yes! I am sure. Delete it.')}}
                    </button>
                </div>
            </template>
        </Modal>

        <div class="upload-sections">
            <!--=================================================================
             STEP 1
            -=================================================================-->
            <div class="upload-section" v-if="step === 1" v-cloak>
                <div class="flex flex-wrap w-full lg:w-3/4 mx-auto">
                    <div class="w-full lg:w-1/2">
                        <div class="tabs">
                            <div class="tab-header">
                                <div class="tab-pane" :class="{'tab-pane--active' : registerActive}">
                                 <span class="tab-name">
                                    <a href="#" @click.prevent="registerActive = true">{{
                                        trans.get('__JSON__.register') }}</a>
                                 </span>
                                </div>

                                <div class="tab-pane" :class="{'tab-pane--active' : !registerActive}">
                                 <span class="tab-name">
                                    <a href="#" @click.prevent="registerActive = false">{{ trans.get('__JSON__.login')
                                        }}</a>
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

                    <div class="w-1/2 hidden lg:block text-left">
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

                <div class="w-full lg:w-3/4 mx-auto flex flex-wrap items-start mb-12">
                    <div class="mb-8 md:mb-0 w-2/3 md:w-2/5 service-title">
                        <h3 class="w-full leading-normal pt-24">{{ trans.get(`__JSON__.Choose a proper service for your need`)}}</h3>
                    </div>

                    <div class="w-full md:w-3/5 bg-white p-8 rounded shadow">
                        <div>
                            <div class="select mb-1">
                                <select name="service" id="service" @change="onSelect" v-model="selected">
                                    <option value="">{{ trans.get('__JSON__.Select a service')}}</option>

                                    <option v-for="service in options" v-bind:value="service.id">
                                        {{ service.name }}
                                    </option>
                                </select>

                                <div class="select__icon">
                                    <svg class="select__svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                    </svg>
                                </div>
                            </div>

                            <p class="bg-yellow-lightest text-yellow-darker text-xs p-2 rounded leading-normal"
                               v-show="contract">
                                {{ trans.get('__JSON__.For books, price and time calculation is adaptive. We will contact you ASA, for further communications. We are appreciate you.') }}
                            </p>
                        </div><!-- .mb-3 -->

                        <hr class="my-6" v-if="!contract">

                        <div class="flex items-center text-sm mb-3" v-show="!contract">
                            <span class="mb-0 flex items-center text-grey">
                                <svg class="fill-current ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 24 24"
                                     width="24"
                                      height="24"><path class="heroicon-ui" d="M17 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2h2V3a1 1 0 1 1 2 0v1h6V3a1 1 0 0 1 2 0v1zm-2 2H9v1a1 1 0 1 1-2 0V6H5v4h14V6h-2v1a1 1 0 0 1-2 0V6zm4 6H5v8h14v-8z"/></svg>
                                <span class="text-grey-darker">{{ trans.get('__JSON__.Delivery date: (Estimated)')}}</span>
                            </span>
                            <span class="mr-auto tag tag--info" v-if="deliverDate">
                                {{ persianNumber.toPersian(deliverDate) }}
                            </span>
                        </div>

                        <p class="bg-yellow-lightest text-yellow-darker text-xs p-2 rounded leading-normal"
                           v-if="deliverDate">{{ trans.get('__JSON__.If the delivery date is further than what you had expected, please contact supports for help.')
                            }}</p>

                        <hr class="my-6" v-if="!contract">


                        <div class="flex text-sm bg-white items-center" v-show="!contract">
                            <span class="mb-0 flex items-center text-grey">
                                <svg class="fill-current h-5 w-5 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                      height="24"><path class="heroicon-ui" d="M7 5H5v14h14V5h-2v10a1 1 0 0 1-1.45.9L12 14.11l-3.55 1.77A1 1 0 0 1 7 15V5zM5 3h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2zm4 2v8.38l2.55-1.27a1 1 0 0 1 .9 0L15 13.38V5H9z"/></svg>

                                <span class="text-grey-darker">{{ trans.get('__JSON__.article(s) word count')}}</span>
                            </span>

                            <span class="mr-auto tag tag--info" v-show="words">
                                {{ persianNumber.toPersian(words) + ' کلمه' }}
                            </span>
                        </div>
                    </div><!-- w-3/5 -->
                </div><!-- w-3/4 -->

                <div class="w-full lg:w-1/3 bg-white rounded shadow mx-auto p-6" v-if="priceIsAvailable">
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
                                <li>تاریخ تحویل: {{ persianNumber.toPersian(deliverDate) }}</li>
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
    import ProgressLevel from "../components/ProgressLevel";

    export default {
        props: ['services'],

        components: {
            UploaderFile,
            Tab,
            UploadRegisterForm,
            UploadLoginForm,
            Modal,
            ProgressLevel
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
                axios.delete(`/users/${this.user.id}/orders/${this.order.id}`)
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

                axios.post(`/users/${this.user.id}/drafts`, {
                    'service_id': this.selected,
                    'order_id': this.order.id
                }).then(res => {
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

<style>
    .service-title {
        min-height: 240px;
        background-image:url('/images/custom-title-bg.svg');
        background-size: auto 240px;
        background-repeat: no-repeat;
        background-position: left center;
    }
</style>


