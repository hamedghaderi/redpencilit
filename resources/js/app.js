
import './bootstrap.js';

window.Vue = require('vue');
window.events = new Vue();

window.flash = function (message, level = 'success') {
    window.events.$emit('flash', {message, level});
}

if (process.env.NODE_ENV === "production") {
  Vue.config.devtools = false;
}

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.directive('dropdown-outside-click', {
  bind: function(el, binding, vnode) {
    document.body.addEventListener('click', function(event) {
      if (
          event.target !== el && // element which clicked on is not the current element
          event.target.id !== binding.value.ref // and it's not event the toggler button
      ) {
        vnode.context[binding.value.method](event); // then run hide event on the content
      }
    });
  }
});

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('navbar-dropdown', require('./components/NavbarDropdown.vue').default);
Vue.component('avatar', require('./components/Avatar.vue').default);
Vue.component('upload-view', require('./pages/UploadView.vue').default);
Vue.component('user-account-form', require('./pages/UserAccountForm.vue').default);
Vue.component('update-general-settings', require('./pages/UpdateGeneralSettings.vue').default);
Vue.component('flash', require('./components/Flash.vue').default);

Vue.component('upload-service', {
    data() {
      return {
        showUpdateButton: false,
          user: []
      };
    },

   methods: {
      onChange() {
        this.showUpdateButton = true;
     },
   }
});
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */





const app = new Vue({
  el: '#app',
});
