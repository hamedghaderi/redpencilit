<template>
    <div>
        <div class="flex mb-12">
            <div class="w-1/2">
                <div class="p-6">
                    <h3 class="dashboard-title">ایجاد سرویس جدید</h3>

                    <p class="dashboard-text">این گونه سرویس‌ها روی نحوه‌ی محاسبه‌ی هزینه تاثیر می‌گذارند. مثلا کاربری که
                        سرویس کتاب را
                        انتخاب
                        کند، قیمت نهایی و زمان، دیگر بستگی به تعداد کلمات ندارد و به صورت توافقی مشخص خواهد شد.</p>
                </div>
            </div>

            <div class="w-1/2">
                <div class="p-6">
                    <div class="bg-white shadow p-6 rounded">
                        <form method="POST" @submit.prevent="saveService">
                            <div class="form-group">
                                <label for="name" class="dashboard-label">نام سرویس جدید</label>
                                <input class="dashboard-input" type="text" name="name" id="name" v-model="name">


                                <div class="feedback feedback--invalid my-2" v-if="errors.has('name')">
                                    <p>
                                        {{ errors.get('name') }}
                                    </p>
                                </div>
                            </div>

                            <div class="form-group flex items-center">
                                <label for="negotiable-update" class="dashboard-label mb-0 label-check">
                                    <input type="checkbox"
                                           class="form-checkbox check-custom d-inline ml-2"
                                           name="negotiable"
                                           id="negotiable-update"
                                            v-model="negotiable">
                                    <span class="check-toggle ml-2"></span>

                                    قیمت به صورت مذاکره‌ای
                                </label>
                            </div>

                            <div class="feedback feedback--invalid my-2" v-if="errors.has('negotiable')">
                                <p>
                                    {{ errors.get('negotiable') }}
                                </p>
                            </div>

                            <div class="form-group mb-0">
                                <button type="submit" class="button button--smooth--primary">ذخیره
                                    سرویس</button>
                            </div>
                        </form>
                    </div>
                </div>  <!-- .p-6 -->
            </div><!-- w-1/2 -->
        </div><!-- flex -->

        <hr>

        <div class="px-6">
            <h3 class="dashboard-title mb-8">سرویس‌های موجود</h3>

            <div class="row px-6 mb-2 flex">
                <div class="w-1/5 text-sm text-grey-dark">نام سرویس</div>
                <div class="w-1/5 text-sm text-grey-dark">تاریخ ایجاد سرویس</div>
                <div class="w-1/5 text-sm text-grey-dark">تاریخ به روز رسانی</div>
            </div>


            <div class="row mb-3" v-for="service in services" :key="service.id">
                <div class="bg-white px-6 py-3 shadow flex items-center relative">

                    <div class="w-1/5 text-grey-darker">
                        {{ service.name }}
                    </div>

                    <div class="w-1/5 text-grey-darker">
                        {{ moment(service.created_at).locale('fa').fromNow() }}
                    </div>

                    <div class="w-1/5 text-grey-darker">
                        {{ moment(service.updated_at).locale('fa').fromNow() }}
                    </div>

                    <div class="w-1/5">
                        <button type="button" class="button button--smooth--success button--sm"
                                @click="openEdit(service.id)">ویرایش
                            اطلاعات</button>
                    </div>

                    <div class="w-1/5">
                        <form method="POST" @submit.prevent="deleteService(service.id)">
                            <button class="button button--smooth--danger button--sm">حذف سرویس</button>
                        </form>
                    </div>
                </div>
            </div>

            <modal v-if="modal" @closeModal="modal = false">
                <form method="post" @submit.prevent="updateService(serviceForUpdate)" @change="isDisabled = false"
                      @keydown="isDisabled=false">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="name" class="dashboard-label">نام سرویس جدید</label>
                            <input class="dashboard-input"
                                   type="text"
                                   name="update-name"
                                   id="name"
                                  v-model="updatedName">

                            <div class="feedback feedback--invalid my-2" v-if="errors.has('name')">
                                <p>
                                    {{ errors.get('name') }}
                                </p>
                            </div>
                        </div>

                        <div class="form-group flex items-center">
                            <label for="negotiable" class="dashboard-label mb-0 label-check">
                                <input type="checkbox"
                                       class="form-checkbox check-custom d-inline ml-2"
                                       name="update-negotiable"
                                       id="negotiable"
                                       v-model="updatedNegotiable">
                                <span class="check-toggle ml-2"></span>

                                قیمت به صورت مذاکره‌ای
                            </label>
                        </div>

                        <div class="feedback feedback--invalid my-2" v-if="errors.has('negotiable')">
                            <p>
                                {{ errors.get('negotiable') }}
                            </p>
                        </div>

                            <div class="form-group mb-0">
                                <button type="submit" :disabled="isDisabled" class="button button--smooth--primary"
                                        @click>به روز
                                    رسانی
                                    سرویس</button>
                            </div>
                        </div>
                    </form>
                </modal>
            </div>
        </div>
    </div>
</template>

<script>
    import Errors from "../Errors";
    import moment from "jalali-moment";
    import Modal from "../components/Modal";


    export default {
        props: ['user'],

        components: { Modal },

        data() {
            return {
                services: [],
                serviceForUpdate: null,
                errors: new Errors(),
                name: '',
                negotiable: false,
                moment: '',
                modal: false,
                updatedName: '',
                updatedNegotiable: false,
                isDisabled: true
            }
        },

        mounted() {
            axios.get(`/dashboard/services`).then(response => {
                this.services = response.data;
            });

            this.moment = moment;
        },

        methods: {
            saveService() {
                axios.post(`/dashboard/services`, {
                    name: this.name,
                    negotiable: this.negotiable
                }).then(response => {
                    if (response.data.status === 200) {
                        this.services.unshift(response.data.service);
                        this.name = '';
                        this.negotiable = false;
                        flash('سرویس جدید با موفقیت ایجاد شد.')
                    }
                }).catch(error => {
                    this.errors.record(error.response.data.errors);
                })
            },

            deleteService(id) {
              axios.delete(`/dashboard/services/${id}`)
                  .then(response => {
                      this.services = response.data
                  });
            },

            openEdit(id) {
                axios.get(`/dashboard/services/${id}`)
                    .then(response => {
                        if (response.data.status === 200) {
                            this.serviceForUpdate = response.data.service;
                            this.modal = true;
                            this.updatedName = response.data.service.name;
                            this.updatedNegotiable = response.data.service.negotiable;
                        }
                    })
            },

            updateService(service){
                axios.patch(`/dashboard/services/${service.id}`, {
                    name: this.updatedName,
                    negotiable: this.updatedNegotiable
                }).then(response => {
                    if (response.data.status === 200) {
                        this.modal = false;

                        axios.get(`/dashboard/services`).then(response => {
                            this.services = response.data;
                        });

                        this.isDisabled = true;

                        flash('سرویس مورد نظر با موفقیت به روز رسانی شد.');
                    }
                })
            }
        }
    }
</script>