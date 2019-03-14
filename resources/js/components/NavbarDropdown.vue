<template>
    <div class="text-left dropdown">
        <dropdown-toggler @toggle="toggleDropdown" class="mb-3" visibile="show">
            {{ user ? user.name : 'حساب کاربری' }}
        </dropdown-toggler>

        <div v-show="show" class="dropdown__content dropdown__content--left">
            <dropdown-content v-if="!signedIn">
                <dropdown-item href="/login">
                    <i class="fas fa-sign-out-alt"></i>
                    ورود به حساب کاربری
                </dropdown-item>

                <dropdown-item href="/register">
                    <i class="fas fa-user-plus"></i>
                    ثبت‌نام
                </dropdown-item>
            </dropdown-content>

            <dropdown-content v-else>
                <dropdown-item>
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ user }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item"
                           href="/logout"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            خروج از حساب کاربری
                        </a>

                        <form id="logout-form" action="/logout" method="POST" style="display: none;">
                        </form>
                    </div>
                </dropdown-item>
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
               user: this.signedInUser || null,
               show: false,
           }
       },

       computed: {
           signedIn() {
               return window.Redpencilit.signed;
           },

           signedInUser() {
               return window.Redpencilit.user;
           }
       },

       methods: {
           toggleDropdown() {
               this.show = !this.show;
           }
       }
   }
</script>