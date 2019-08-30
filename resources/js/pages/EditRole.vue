<template>
    <div>
        <h3>{{ user.name }}</h3>

        <hr class="mb-2 pt-6">

       <div class="flex">
           <div v-for="role in roles" class="w-1/3">
               <label class="label-check">
                   <input class="form-checkbox check-custom" type="checkbox" :value="role.id" v-model="roleIds"
                          :disabled="role.name=='super-admin'">
                   <span class="check-toggle ml-2"></span>
                   {{ role.label }}
               </label>
           </div>
       </div>

        <hr class="mt-6">

        <div>
            <button class="button button--smooth--primary" @click="submitRoles">ذخیره تغییرات</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user', 'roles'],

        created() {
            for (let index in this.user.roles) {
               this.roleIds[index]  = this.user.roles[index].id;
            }
        },

        data() {
            return {
                roleIds: []
            }
        },

        methods: {
           submitRoles() {
               axios.post('/users/' + this.user.username + '/roles', {
                   'roles': this.roleIds,
               }).then(response => {
                    document.location = '/users';
               }).catch(error => {
                   flash('عملیات با شکست مواجه شد. لطفا مجددا امتحان کنید.', 'danger');
               })
           }
        },
    }
</script>