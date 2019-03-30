<template>
    <div>
        <div id="upload" class="w-3/4 mx-auto mb-3">
            <div id="file-uploader"></div>
        </div>

        <div class="test" v-if="test">
            <h1>Hello</h1>
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
        data() {
            return {
                uppy: null,
                articles: [],
                test: false
            }
        },
        mounted() {
            let csrf = document.getElementById('csrf').getAttribute('content');

            const uppy = Uppy(uppy_settings)
                .use(Dashboard, dashboard_settings)
                .use(XHRUpload, {
                    endpoint: '/api/documents',
                    bundle: true,
                    fieldName: 'articles[]',
                    headers: {
                        'X-CSRF-TOKEN': csrf
                    },
                    getResponseError(responseText, xhr) {
                        return new Error(responseText) ;
                    }
                });

            this.uppy = uppy;

            uppy.on('upload-success', (file, response) => {
                this.$emit('fileUploaded', response.body.words);
            });
        },
    }
</script>