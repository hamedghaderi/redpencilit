<template>
    <div>
        <input id="trix" type="hidden" :name="name">

        <trix-editor ref="trix" class="trix-content" input="trix"></trix-editor>
    </div>
</template>

<script>
    import Trix from 'trix';

    export default {
        props: ['name', 'host'],

        mounted() {
            this.$refs.trix.addEventListener('trix-file-accept', (e) => {
                let fileType = e.file.type;
                let validTypes = ['image/jpeg', 'image/png', 'image/jpg'];

                let found = validTypes.find(type => type === fileType);

                if (!found) {
                    flash('فرمت فایل وارد شده صحیح نیست.', 'danger');

                    e.preventDefault();
                }

                if (e.file.size > 400000) {
                    console.log(e.file.size);
                    flash('حجم فایل نباید بیشتر از ۴۰۰ کیلوبایت باشد.', 'danger');

                    e.preventDefault();
                }
            });

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

                axios.post('/post-attachments', formData, {
                    header: {
                        'Content-Type': 'multipart/form-data'
                    },

                    onUploadProgress: function (progressEvent) {
                        let progress = progressEvent.loaded / progressEvent.total * 100;
                        progressCallback(progress);
                    },
                }).then(res => {
                    let attributes = {
                        url: this.host + 'storage/blog/' + key,
                        href: this.host + 'storage/blog/' + key + "?content-disposition=attachment"
                    };
                    successCallback(attributes);
                }).catch(error => {
                    flash(error.response.data.errors.attachment[0], 'danger');
                    successCallback({});
                });
            },

            createFormData(key, file) {
                let data = new FormData();
                data.append("key", key);
                data.append("Content-Type", file.type);
                data.append("attachment", file);

                return data;
            },

            createStorageKey(file) {
                let date = new Date();
                let name = date.getTime() + '-' + file.name;

                return name;
            }
        }
    }
</script>