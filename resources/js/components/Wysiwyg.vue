<template>
    <div>
        <input id="trix" type="hidden" :name="name">

        <trix-editor ref="trix" class="trix-content" input="trix"></trix-editor>
    </div>
</template>

<script>
    import Trix from 'trix';

    export default {
        props: ['name'],

        mounted() {
            this.$refs.trix.addEventListener('trix-attachment-add', (e) => {
                if (e.attachment.file) {
                    this.uploadFileAttachment(e.attachment);
                }
            });
        },

        methods: {
            uploadFileAttachment(attachment) {
                this.uploadFile(attachment.file, setProgress, setAttributes);

                function setProgress(progress) {
                    attachment.setUploadProgress(progress);
                }

                function setAttributes(attributes) {
                    attachment.setAttributes(attributes);
                }
            },

            uploadFile(file, progressCallback, successCallback) {
                let key = this.createStorageKey(file);
                let formData = this.createFormData(key, file);

                axios.post('/post-attachments', formData).then(res => {
                   console.log('response')
                }).catch(error => {
                   console.log('error') ;
                });
            },

            createStorageKey(file) {
                let date = new Date();
                let day = date.toISOString().slice(0, 10);
                let name = date.getTime() + '-' + file.name;

                return ['tmp', day, name].join('/');
            },

            createFormData(key, file) {
                let data = new FormData();
                data.append("key", file);
                data.append("Content-Type", file.type);
                data.append("file", file);
                return data;
            }
        }
    }
</script>