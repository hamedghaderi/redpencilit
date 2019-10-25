<template>

</template>

<script>
   export default {
      props: ['data', 'degrees'],

      created() {
         this.user = this.data;
         this.details = "deatils" in this.user ? this.user['details'] : this.details;
      },

      data() {
         return {
            user: null,
            details: {
            },
            showEdit: false,
            formGroup: {
               'form-group': this.showEdit
            }
         }
      },

      methods: {
         onEdit() {
            this.showEdit = true;
         },

         onCancelEdit() {
            this.showEdit = false;
         }
      }
   }
</script>

<style>

</style>