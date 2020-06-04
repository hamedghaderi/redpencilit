<template>
    <div class="dashboard-nav__avatar" :style="imageUrl">
        <span class="dashboard-nav__avatar-gear" @click="openUploader">
            <i class="las la-plus text-lg"></i>
        </span>

        <input type="file" id="uploader" name="avatar" style="display: none;" @change="uploadAvatar">
    </div>
</template>

<script>
    export default {
        props: ['image', 'user'],

        created() {
            if (this.user && this.user.avatar) {
                this.path = '/storage/' + this.image;
            } else {
                this.path = this.image;
            }
        },

        data() {
            return {
                avatarFormInput: null,
                path: ''
            }
        },

        computed: {
            imageUrl() {
                return 'background-image: url(' + this.path + ')';
            }
        },

        mounted() {
            this.avatarFormInput = document.getElementById('uploader');
        },

        methods: {
            openUploader()  {
                this.avatarFormInput.click();
            },

            uploadAvatar() {
                let form = new FormData;

                form.append('avatar', this.avatarFormInput.files[0]);

                axios.post(`/${Redpencilit.locale}/api/users/${this.user}/avatar`, form)
                    .then(response => {
                        this.path = '/storage/' + response.data.path;
                    });
            }
        }
    }
</script>
