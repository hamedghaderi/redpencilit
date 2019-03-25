
window.Vue = require('vue');

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
Vue.component('upload-view', require('./pages/UploadView.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */





const app = new Vue({
  el: '#app',
});
