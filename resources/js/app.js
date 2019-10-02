import './bootstrap.js';

window.Vue = require('vue');

let authorizations = require('./authorizations');

window.events = new Vue();

window.flash = function (message, level = 'success') {
    window.events.$emit('flash', {message, level});
}

Vue.mixin({
    methods: {
        persianReplace(str = '') {
            let persianNumberArr = [/۰/g, /۱/g, /۲/g, /۳/g, /۴/g, /۵/g, /۶/g, /۷/g, /۸/g, /۹/g];
            let arabicNumberArr = [/٠/g, /١/g, /٢/g, /٣/g, /٤/g, /٥/g, /٦/g, /٧/g, /٨/g, /٩/g];

            let englishNumberArr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];

            if (str.length === 0 ) {
                return str;
            }

            for (let i = 0; i < 10; i++) {
                str = str.replace(persianNumberArr[i], englishNumberArr[i])
                    .replace(arabicNumberArr[i], englishNumberArr[i]);
            }

            return str;
        },

        sanitizeNumber(e) {
            return this.$set(
                this.formSetting,
                e.target.name,
                this.persianReplace(e.target.value)
            );
        }
    }
});

Vue.prototype.authorize = function (...params) {
    if (!window.Redpencilit.signed) return false;

    if (typeof params[0] === 'string') {
        return authorizations[params[0]](params[1]);
    }

    return params[0](window.Redpencilit.user);
};

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

Vue.component('nav-dropdown', require('./components/NavDropdown.vue').default);
Vue.component('dropdown', require('./components/Dropdown.vue').default);
Vue.component('avatar', require('./components/Avatar.vue').default);
Vue.component('flash', require('./components/Flash.vue').default);
Vue.component('flex-table', require('./components/FlexTable.vue').default);
Vue.component('inner-modal', require('./components/InnerModal.vue').default);

Vue.component('edit-role', require('./pages/EditRole.vue').default);
Vue.component('upload-view', require('./pages/UploadView.vue').default);
Vue.component('services', require('./pages/Services.vue').default);
Vue.component('user-account-form', require('./pages/UserAccountForm.vue').default);
Vue.component('update-general-settings', require('./pages/UpdateGeneralSettings.vue').default);
Vue.component('wysiwyg', require('./components/Wysiwyg.vue').default);
Vue.component('favorite', require('./components/Favorite.vue').default);

Vue.config.ignoredElements = ['trix-editor'];


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

