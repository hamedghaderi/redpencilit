<template>
    <div class="text-left dropdown">
        <dropdown-toggler @toggle="toggleDropdown" visibile="show">
            {{ user ? user.name : 'حساب کاربری' }}
        </dropdown-toggler>

        <div v-show="show" class="dropdown__content dropdown__content--left">
            <dropdown-content v-if="!isSignedIn" @hideDropdown="closeDropdown">
                <dropdown-item href="/login">
                    <i class="fas fa-sign-out-alt"></i>
                    ورود به حساب کاربری
                </dropdown-item>

                <dropdown-item href="/register">
                    <i class="fas fa-user-plus"></i>
                    ثبت‌نام
                </dropdown-item>
            </dropdown-content>

            <dropdown-content v-else @hideDropdown="closeDropdown">
                <dropdown-item :href="dashboard">
                    <i class="fas fa-tachometer-alt"></i>
                   داشبورد
                </dropdown-item>

                <div @click="logout">
                    <dropdown-item href="#">
                        <i class="fas fa-sign-out-alt"></i>
                        خروج از حساب کاربری

                        <form id="logout-form" action="/logout" method="POST" style="display: none;">
                            <input type="hidden" :value="token" name="_token">
                        </form>
                    </dropdown-item>
                </div>

            </dropdown-content>
        </div>
    </div>
</template>

<script>
   import DropdownToggler from './DropdownToggler';
   import DropdownContent from './DropdownContent';
   import DropdownItem from './DropdownItem';

   export default {
       components: { DropdownToggler, DropdownContent, DropdownItem },

       data() {
           return {
               user: false,
               isSignedIn: false,
               show: false,
               token: null,
               data: null,
           }
       },

       created() {
            this.token = document.querySelector('meta[name="csrf-token"]').content;

            this.isSignedIn = this.signedIn;
            this.user = this.signedInUser;

            window.events.$on('userCreated', data => this.showUser(data));
       },

       computed: {
           signedIn() {
               return window.Redpencilit.signed;
           },

           signedInUser() {
               return window.Redpencilit.user;
           },

           dashboard() {
               return '/dashboard/' + this.user.username;
           }
       },

       methods: {
           toggleDropdown() {
               this.show = !this.show;
           },

           closeDropdown() {
               this.show = false;
           },

           logout() {
                document.getElementById('logout-form').submit();
           },

           showUser(data) {
              this.user = data;
              this.isSignedIn = true;
           }
       }
   }
</script>