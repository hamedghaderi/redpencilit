<template>
    <div>
        <div class="lg:flex mb-12">
            <div class="lg:w-1/2">
                <div class="p-6">
                    <h3 class="dashboard-title">
                        {{ trans.get('__JSON__.create a new service') }}
                    </h3>

                    <p class="dashboard-text">
                        {{ trans.get('__JSON__.These kinds of services, take effect on the final price. For example, a user who select the book service, neither price nor delivery date doesnt depend on words count and will be calculated in an agreement.')}}</p>
                </div>
            </div>

            <div class="lg:w-1/2">
                <div class="p-6">
                    <div>
                        <form method="POST" @submit.prevent="saveService">
                            <tabs>
                                <tab title="فارسی">
                                    <div class="form-group">
                                        <label for="fa-name"
                                               class="label">
                                            {{ trans.get('__JSON__.new service name') }}
                                        </label>

                                        <input class="input"
                                               type="text"
                                               id="fa-name"
                                               v-model="name.fa">

                                        <div class="feedback feedback--invalid my-2"
                                             v-if="errors.has('fa-name')">
                                            <p>
                                                {{ errors.get('fa-name') }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="feedback feedback--invalid my-2"
                                         v-if="errors.has('negotiable')">
                                        <p>
                                            {{ errors.get('negotiable') }}
                                        </p>
                                    </div>
                                </tab>

                                <tab title="English">
                                    <div class="form-group text-left">
                                        <label for="en-name" class="label">New Service Name</label>
                                        <input
                                                class="input text-left"
                                                type="text"
                                                id="en-name"
                                                v-model="name.en">

                                        <div class="feedback feedback--invalid my-2"
                                             v-if="errors.has('en-name')">
                                            <p>
                                                {{ errors.get('en-name') }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="feedback feedback--invalid my-2"
                                         v-if="errors.has('negotiable')">
                                        <p>
                                            {{ errors.get('negotiable') }}
                                        </p>
                                    </div>
                                </tab>

                                <div class="form-group mb-0">
                                    <button type="submit" class="button button--smooth--primary">
                                        {{ trans.get('__JSON__.save service')}}
                                    </button>
                                </div>
                            </tabs>
                        </form>
                    </div>
                </div>  <!-- .p-6 -->
            </div><!-- w-1/2 -->
        </div><!-- flex -->

        <hr>

        <div class="px-6 mb-24">
            <h3 class="dashboard-title mb-8">
                {{ trans.get('__JSON__.current services')}}
            </h3>

            <div class="overflow-x-scroll lg:overflow-visible">
                <div style="min-width: 768px;">
                    <div class="row px-6 mb-2 flex">
                        <div class="w-1/5 text-sm text-grey-dark">{{ trans.get('__JSON__.service name')}}
                        </div>
                        <div class="w-1/5 text-sm text-grey-dark">{{ trans.get('__JSON__.created at')}}
                        </div>
                        <div class="w-1/5 text-sm text-grey-dark">{{ trans.get('__JSON__.updated at')}}
                        </div>
                    </div>


                    <div class="row mb-3" v-for="service in services"
                         :key="service.id">
                        <div class="bg-white px-6 py-3 shadow flex items-center relative">
                            <div class="w-1/5 text-grey-darker">
                                {{ service.name[locale] }}
                            </div>

                            <div class="w-1/5 text-grey-darker">
                                {{ moment(service.created_at).locale(locale).fromNow() }}
                            </div>

                            <div class="w-1/5 text-grey-darker">
                                {{ moment(service.updated_at).locale(locale).fromNow() }}
                            </div>

                            <div class="w-1/5">
                                <button type="button" class="button button--smooth--success button--sm"
                                        @click="openEdit(service.id)">
                                    {{ trans.get('__JSON__.edit info') }}
                                </button>
                            </div>

                            <div class="w-1/5">
                                <form method="POST" @submit.prevent="deleteService(service.id)">
                                    <button class="button button--smooth--danger button--sm">
                                        {{ trans.get('__JSON__.delete service') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <modal v-if="modal" @closeModal="modal = false">
                <form method="POST" @submit.prevent="updateService(serviceForUpdate)"
                      @change="isDisabled = false" @keydown="isDisabled = false">
                    <tabs>
                        <tab title="فارسی">
                            <div class="form-group">
                                <label for="fa-name"
                                       class="label">
                                    {{ trans.get('__JSON__.new service name') }}
                                </label>

                                <input class="input"
                                       type="text"
                                       v-model="updateName.fa">

                                <div class="feedback feedback--invalid my-2"
                                     v-if="updateErrors.has('fa-name')">
                                    <p>
                                        {{ updateErrors.get('fa-name') }}
                                    </p>
                                </div>
                            </div>
                        </tab>

                        <tab title="English">
                            <div class="form-group text-left">
                                <label for="en-name" class="label">New Service Name</label>
                                <input
                                        class="input text-left"
                                        type="text"
                                        v-model="updateName.en">

                                <div class="feedback feedback--invalid my-2"
                                     v-if="updateErrors.has('en-name')">
                                    <p>
                                        {{ updateErrors.get('en-name') }}
                                    </p>
                                </div>
                            </div>
                        </tab>

                        <div class="form-group mb-0">
                            <button type="submit" class="button button--smooth--primary">
                                {{ trans.get('__JSON__.save service')}}
                            </button>
                        </div>
                    </tabs>
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
        props: ['user', 'allServices'],

        components: {Modal},

        created() {
            this.services = this.allServices;
            this.moment = moment;
        },

        data() {
            return {
                services: [],
                serviceForUpdate: null,
                errors: new Errors(),
                updateErrors: new Errors(),
                name: {
                    fa: '',
                    en: ''
                },
                negotiable: false,
                moment: '',
                modal: false,
                updateName: {
                    fa: '',
                    en: ''
                },
                updatedNegotiable: false,
                isDisabled: true,
                locale: Redpencilit.locale
            }
        },

        methods: {
            saveService() {
                axios.post(`/${Redpencilit.locale}/dashboard/services`, {
                    "fa-name": this.name.fa,
                    "en-name": this.name.en,
                    negotiable: this.negotiable
                }).then(response => {
                    if (response.data.status === 200) {
                        this.services.unshift(response.data.service);
                        this.name.fa = "";
                        this.name.en = "";
                        this.negotiable = false;
                        flash('سرویس جدید با موفقیت ایجاد شد.')
                    }
                }).catch(error => {
                    this.errors.record(error.response.data.errors);
                })
            },

            deleteService(id) {
                axios.delete(`/${this.locale}/dashboard/services/${id}`)
                    .then(response => {
                        this.services = this.services.filter(service => service.id !== id);
                        flash('سرویس با موفقیت حذف شد.');
                    });
            },

            openEdit(id) {
                this.serviceForUpdate = this.services.find(service => service.id === id);
                this.modal = true;
                this.updateName = this.serviceForUpdate.name;
            },

            updateService(service) {
                axios.patch(`/${Redpencilit.locale}/dashboard/services/${service.id}`, {
                    "fa-name": this.updateName.fa,
                    "en-name": this.updateName.en,
                }).then(response => {
                    if (response.data.status === 200) {
                        this.modal = false;
                        this.isDisabled = true;
                        flash('سرویس مورد نظر با موفقیت به روز رسانی شد.');
                    }
                }).catch(error => {
                    this.updateErrors.record(error.response.data.errors);
                })
            }
        }
    }
</script>
