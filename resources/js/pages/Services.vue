<template>
    <div>
        <div class="flex mb-12">
            <div class="w-1/2">
                <div class="p-6">
                    <h3 class="dashboard-title">
                       {{ trans.get('__JSON__.create a new service') }}
                    </h3>

                    <p class="dashboard-text">
                        {{ trans.get('__JSON__.These kinds of services, take effect on the final price. For example, a user who select the book service, neither price nor delivery date doesnt depend on words count and will be calculated in an agreement.')}}
                    </p>
                </div>
            </div>

            <div class="w-1/2">
                <div class="p-6">
                    <div class="bg-white shadow p-6 rounded">
                        <form method="POST" @submit.prevent="saveService">
                            <div class="form-group">
                                <label for="name" class="label">{{ trans.get('__JSON__.new service name')}}</label>
                                <input class="input" type="text" name="name" id="name" v-model="name">


                                <div class="feedback feedback--invalid my-2" v-if="errors.has('name')">
                                    <p>
                                        {{ errors.get('name') }}
                                    </p>
                                </div>
                            </div>

                            <div class="form-group flex items-center">
                                <label for="negotiable-update" class="dashboard-label mb-0 label-check">
                                    <input type="checkbox"
                                           class="form-checkbox d-inline ml-2"
                                           name="negotiable"
                                           id="negotiable-update"
                                            v-model="negotiable">

                                    {{ trans.get('__JSON__.agreement price')}}
                                </label>
                            </div>

                            <div class="feedback feedback--invalid my-2" v-if="errors.has('negotiable')">
                                <p>
                                    {{ errors.get('negotiable') }}
                                </p>
                            </div>

                            <div class="form-group mb-0">
                                <button type="submit" class="button button--smooth--primary">
                                    {{ trans.get('__JSON__.save service')}}
                                </button>
                            </div>
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

            <div class="row px-6 mb-2 flex">
                <div class="w-1/5 text-sm text-grey-dark">{{ trans.get('__JSON__.service name')}}</div>
                <div class="w-1/5 text-sm text-grey-dark">{{ trans.get('__JSON__.created at')}}</div>
                <div class="w-1/5 text-sm text-grey-dark">{{ trans.get('__JSON__.updated at')}}</div>
            </div>


            <div class="row mb-3" v-for="service in services" :key="service.id">
                <div class="bg-white px-6 py-3 shadow flex items-center relative">

                    <div class="w-1/5 text-grey-darker">
                        {{ service.name }}
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

            <modal v-if="modal" @closeModal="modal = false">
                <form method="post" @submit.prevent="updateService(serviceForUpdate)" @change="isDisabled = false"
                      @keydown="isDisabled=false">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="modal-name" class="label">{{ trans.get('__JSON__.new service name') }}</label>
                            <input class="input"
                                   type="text"
                                   name="update-name"
                                   id="modal-name"
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
                                       class="form-checkbox d-inline ml-2"
                                       name="update-negotiable"
                                       id="negotiable"
                                       v-model="updatedNegotiable">

                               {{ trans.get('__JSON__.negotiable price') }}
                            </label>
                        </div>

                        <div class="feedback feedback--invalid my-2" v-if="errors.has('negotiable')">
                            <p>
                                {{ errors.get('negotiable') }}
                            </p>
                        </div>

                            <div class="form-group mb-0">
                                <button type="submit" :disabled="isDisabled" class="button button--smooth--primary"
                                        @click>
                                    {{ trans.get('__JSON__.update service') }}
                                </button>
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
                isDisabled: true,
                locale: Redpencilit.locale
            }
        },

        mounted() {
            axios.get(`/${Redpencilit.locale}/dashboard/services`).then(response => {
                this.services = response.data;
            });

            this.moment = moment;
        },

        methods: {
            saveService() {
                axios.post(`/${Redpencilit.locale}/dashboard/services`, {
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
              axios.delete(`/${this.locale}/dashboard/services/${id}`)
                  .then(response => {
                      this.services = response.data
                      flash('سرویس با موفقیت حذف شد.');
                  });
            },

            openEdit(id) {
                axios.get(`/${this.locale}/dashboard/services/${id}`)
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
                axios.patch(`/${Redpencilit.locale}/dashboard/services/${service.id}`, {
                    name: this.updatedName,
                    negotiable: this.updatedNegotiable
                }).then(response => {
                    if (response.data.status === 200) {
                        this.modal = false;

                        axios.get(`/${Redpencilit.locale}/dashboard/services`).then(response => {
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