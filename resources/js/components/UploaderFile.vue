<template>
    <div>
        <div id="upload" class="w-3/4 mx-auto mb-3">
            <div id="file-uploader"></div>
        </div>
    </div>
</template>

<script>
   import Uppy from '@uppy/core';
   import Dashboard from '@uppy/dashboard';
   import XHRUpload from '@uppy/xhr-upload';
   import {dashboard_settings} from '../settings/uppy-dashboard';
   import {uppy_settings} from "../settings/uppy";

   export default {
        props: ['user', 'token'],

        data() {
            return {
                uppy: null,
                articles: [],
                test: false,
                endpoint: null,
            }
        },

       created() {
            if (!this.user) {
                this.endpoint = `/users/${window.Redpencilit.user.username}/documents`;
            } else {
                this.endpoint = `/users/${this.user.username}/documents`;
            }
       },


        mounted() {
            let token = this.token ? this.token : document.getElementById('csrf').getAttribute('content');

            const uppy = Uppy(uppy_settings)
                .use(Dashboard, dashboard_settings)
                .use(XHRUpload, {
                    endpoint: this.endpoint,
                    bundle: true,
                    fieldName: 'articles[]',
                    headers: {
                        'X-CSRF-TOKEN': token,
                    },
                    getResponseError(responseText, xhr) {
                        return new Error(responseText) ;
                    }
                });

            this.uppy = uppy;

            uppy.on('upload-success', (file, response) => {
                this.$emit('fileUploaded', response.body);
            });
        },
    }
</script>