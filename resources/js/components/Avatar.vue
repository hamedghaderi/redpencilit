<template>
    <div class="dashboard-nav__avatar" :style="imageUrl">
        <span class="dashboard-nav__avatar-gear" @click="openUploader">
            <i class="fas fa-cog"></i>
        </span>

        <input type="file" id="uploader" name="avatar" style="display: none;" @change="uploadAvatar">
    </div>
</template>

<script>
    export default {
        props: ['image', 'user'],

        data() {
            return {
                avatarFormInput: null,
                path: this.image
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

                axios.post(`/api/users/${this.user}/avatar`, form)
                    .then(response => {
                        console.log(this.imageUrl);
                        this.path = '/storage/' + response.data.path;
                    });
            }
        }
    }
</script>