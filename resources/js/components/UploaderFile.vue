<template>
    <div>
        <div id="upload" class="w-full lg:w-3/4 mx-auto mb-3">
            <div id="file-uploader"></div>
        </div>
    </div>
</template>

<script>
    const Uppy = require('@uppy/core');
    const XHRUpload = require('@uppy/xhr-upload');
    const Dashboard = require('@uppy/dashboard');



    import {dashboard_settings, Persian, US} from '../settings/uppy-dashboard';
    import {uppy_settings} from "../settings/uppy";

    export default {
        props: ['user', 'token'],

        data() {
            return {
                uppy: null,
                documents: [],
                endpoint: null,
                locale: Redpencilit.locale
            }
        },

        created() {
            if (!this.user) {
                this.endpoint = `/${this.locale}/users/${window.Redpencilit.user.id}/orders`;
            } else {
                this.endpoint = `/${this.locale}/users/${this.user.id}/orders`;
            }

            dashboard_settings.locale = this.locale === 'fa' ? Persian : US;
        },


        mounted() {
            let token = this.token ? this.token : document.getElementById('csrf').getAttribute('content');

            const uppy = Uppy(uppy_settings)
                .use(Dashboard, dashboard_settings)
                .use(XHRUpload, {
                    endpoint: this.endpoint,
                    bundle: true,
                    fieldName: 'documents[]',
                    headers: {
                        'X-CSRF-TOKEN': token,
                    },
                    getResponseError(responseText, xhr) {
                        return new Error(responseText);
                    }
                });

            this.uppy = uppy;

            uppy.on('upload-success', (file, response) => {
                this.$emit('fileUploaded', response.body.data);
            });
        },
    }
</script>