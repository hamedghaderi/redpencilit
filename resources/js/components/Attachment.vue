<template>
    <div>
        <slot></slot>
    </div>
</template>

<script>
    import Errors from "../Errors";

    export default {
        name: "Attachment",

        created() {
            window.events.listen('erroroccured', (errors) => {
                this.errors.record(errors);
            });

            window.events.listen('ticketcreated', () => {
              this.showAttachmentName = this.clearFile();
            });
        },

        data() {
            return {
                filename: '',
                showAttachmentName: false,
                attachment: null,
                locale: window.Redpencilit.locale,
                errors: new Errors()
            }
        },

        methods: {
            uploadFile(event) {
                let path = event.target.value;
                this.filename = path.substr(path.lastIndexOf('\\') + 1);
                this.showAttachmentName = true;
            },

            clearFile(){
                document.getElementById('attachment') .value = '';
                this.showAttachmentName = false;
                this.filename = ''
            }
        }
    }
</script>

<style>

</style>
