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

                    <button class="button button--sm button--outline--danger z-50"
                            :class="[locale === 'fa' ? 'mr-auto' : 'ml-auto']"
                            @click.prevent="cancelIt">
                        {{ trans.get('__JSON__.Yes! I am sure. Delete it.')}}
                    </button>
                </div>
            </template>
        </Modal>

        <div class="upload-sections" style="min-height: 600px;">
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
                                    <a href="#" @click.prevent="registerActive = false">
                                        {{ trans.get('__JSON__.login')}}
                                    </a>
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
                                <i class="las la-calendar text-2xl"></i>
                                <span class="text-grey-darker">{{ trans.get('__JSON__.Delivery date: (Estimated)')}}</span>
                            </span>
                            <span class="tag tag--info" :class="[locale === 'fa' ? 'mr-auto' : 'ml-auto']" v-if="deliverDate">
                                {{ locale === 'fa' ? persianNumber.toPersian(deliverDate) :
                                moment(deliverDate).format('MMMM Do YYYY') }}
                            </span>
                        </div>

                        <p class="bg-yellow-lightest text-yellow-darker text-xs p-2 rounded leading-normal"
                           v-if="deliverDate">{{ trans.get('__JSON__.If the delivery date is further than what you had expected, please contact supports for help.')
                            }}</p>

                        <hr class="my-6" v-if="!contract">


                        <div class="flex text-sm bg-white items-center" v-show="!contract">
                            <span class="mb-0 flex items-center text-grey">
                                <i class="las la-calendar text-2xl"></i>
                                <span class="text-grey-darker">{{ trans.get('__JSON__.article(s) word count')}}</span>
                            </span>

                            <span class="tag tag--info" :class="[locale === 'fa' ? 'mr-auto' : 'ml-auto']"
                                  v-show="words">
                                {{ locale === 'fa' ? persianNumber.toPersian(words) : words + ' ' +
                                trans.get('__JSON__.words') }}
                            </span>
                        </div>
                    </div><!-- w-3/5 -->
                </div><!-- w-3/4 -->

                <div class="w-full lg:w-1/3 bg-white rounded shadow mx-auto p-6" v-if="priceIsAvailable">
                    <p class="text-red border-b border-red pb-3 mb-12">
                        {{ trans.get('__JSON__.total cost')}}
                    </p>


                    <div class="text-center">
                        <h3 class="text-3xl mb-6">
                            <span v-show="!contract">
                                {{ locale === 'fa' ? persianNumber.toPersian(price) : price }}
                                {{trans.get('__JSON__.tomans')}}
                            </span>
                            <span v-show="contract">
                                {{ trans.get('__JSON__.agreement')}}
                            </span>
                        </h3>

                        <button class="button button--primary mb-3" @click="saveSecondStep">
                            {{ trans.get('__JSON__.next step')}}
                        </button>
                        <p class="mb-6">
                            <a class="text-grey-dark text-sm no-underline"
                               @click.prevent="requestToCancel">
                               {{ trans.get('__JSON__.cancel')}}
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

                            <h3 class="text-grey-dark mb-3">{{ trans.get('__JSON__.uploaded files')}}</h3>

                            <div class="list">
                                <li>
                                    {{ locale === 'fa'
                                        ? persianNumber.toPersian(this.order.details.length)
                                        : order.details.length
                                    }}
                                    {{ trans.get('__JSON__.file(s)') }}
                                </li>
                            </div>
                        </section>

                        <section class="px-6 w-1/3 text-center border-l border-grey-lighter">
                            <img class="mb-3 h-24" src="/images/selected-services.svg"
                                 alt="vector girl and rounded icons">

                            <h3 class="text-grey-dark mb-3">{{ trans.get("__JSON__.selected services")}}</h3>

                            <ul class="list">
                                <li v-text="service(selected)"></li>
                                <li>
                                    {{ trans.get('__JSON__.delivery date') }}
                                    {{ locale === 'fa' ? persianNumber.toPersian(deliverDate) : deliverDate }}
                                </li>
                            </ul>
                        </section>

                        <section class="px-6 w-1/3 text-center">
                            <img class="mb-3 h-24" src="/images/price.svg" alt="vector payment cart">

                            <h3 class="text-grey-dark mb-3">{{ trans.get('__JSON__.payable price')}}</h3>

                            <ul class="list">
                                <li>
                                    {{ locale === 'fa' ? persianNumber.toPersian(words) : words }}
                                    {{ trans.get('__JSON__.words')}}
                                </li>
                                <li>
                                    {{ locale === 'fa' ? persianNumber.toPersian(price) : words }}
                                    {{ trans.get('__JSON__.tomans')}}
                                </li>
                            </ul>
                        </section>
                    </div>
                </div>

                <div class="w-3/4 mx-auto flex mb-12" style="min-height: 240px;">
                    <div class="title-custom-bg w-2/5">
                        <h3 class="w-1/2 leading-normal pt-24">{{ trans.get('__JSON__.final review and payment')}}</h3>
                    </div>

                    <div class="w-3/5 flex items-center justify-center">
                        <div class="text-center w-1/2">
                            <a href="#" class="button button--primary button--block mb-6">
                                {{ trans.get('__JSON__.payment')}}
                                <i class="fas fa-arrow-left mr-3"></i>
                            </a>

                            <a href="#" @click="requestToCancel" class="no-underline text-gery">
                                {{ trans.get('__JSON__.cancel') }}
                            </a>
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
                moment: moment,
                modal: false,
                order: null,
                documents: [],
                locale: Redpencilit.locale
            }
        },

        methods: {
            generateSettings(order) {
                this.order = order;
                this.words = this.order.total_words;
                this.price = this.order.price;

                const m = moment(order.delivery_date);

                if (this.locale === 'fa') {
                    m.locale('fa');
                } else {
                    m.local('en');
                }

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
                let url = '/' + this.locale + '/users/' + this.user.id + '/drafts';

                axios.post(url, {
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


