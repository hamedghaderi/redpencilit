import "./bootstrap.js";
import PersianNumber from "./PersianNumber";
import "css.gg/icons/all.css";
import Alpine from "alpinejs";
import { createPopper } from "@popperjs/core";

// Setting Up Popper.JS
window.Popper = createPopper;

window.Alpine = Alpine;
Alpine.start();

import "./components/Dropdown";

window.Vue = require("vue");

let authorizations = require("./authorizations");

import sal from "sal.js";
import Event from "./Event";

window.events = new Event(new Vue());

window.sal = sal;
// window.events = new Vue();
window.PersianNumber = new PersianNumber();

window.flash = function (message, level = "success") {
    // window.events.$emit('flash', {message, level});
    window.events.fire("flash", { message, level });
};

import Lang from "lang.js";

const default_locale = window.default_locale;
const fallback_locale = window.fallback_locale;
const messages = window.messages;

// let test = (Vue.prototype.trans = new Lang({
//     messages,
//     locale: default_locale,
//     fallback: fallback_locale,
// }));
//
// Vue.prototype.authorize = function (...params) {
//     if (!window.Redpencilit.signed) return false;
//
//     if (typeof params[0] === "string") {
//         return authorizations[params[0]](params[1]);
//     }
//
//     return params[0](window.Redpencilit.user);
// };

// if (process.env.NODE_ENV === "production") {
//     Vue.config.devtools = false;
// }

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component("nav-dropdown", require("./components/NavDropdown.vue").default);
// Vue.component("dropdown", require("./components/Dropdown.vue").default);
// Vue.component("avatar", require("./components/Avatar.vue").default);
// Vue.component("flash", require("./components/Flash.vue").default);
// Vue.component("flex-table", require("./components/FlexTable.vue").default);
// Vue.component("inner-modal", require("./components/InnerModal.vue").default);
// Vue.component("attachment", require("./components/Attachment.vue").default);
// Vue.component("modal", require("./components/Modal").default);

// Vue.component("select-tag", require("./components/SelectTag.vue").default);
// Vue.component("tabs", require("./components/Tabs.vue").default);
// Vue.component("tab", require("./components/Tab.vue").default);
// Vue.component("status", require("./components/Status.vue").default);
// Vue.component('attachment', require('./components/Attachment').default);
//
// Vue.component("edit-role", require("./pages/EditRole.vue").default);
// Vue.component("upload-view", require("./pages/UploadView.vue").default);
// Vue.component("services", require("./pages/Services.vue").default);
// Vue.component(
//     "user-account-form",
//     require("./pages/UserAccountForm.vue").default
// );
// // Vue.component("user-details-form", require("./pages/UserDetailsForm").default);
// Vue.component(
//     "update-general-settings",
//     require("./pages/UpdateGeneralSettings.vue").default
// );
// Vue.component("wysiwyg", require("./components/Wysiwyg.vue").default);
// Vue.component("favorite", require("./components/Favorite.vue").default);
// Vue.component("faq", require("./components/Faq.vue").default);
// Vue.component("contact", require("./pages/Contact.vue").default);
// Vue.component("comments", require("./pages/Comments.vue").default);
// Vue.component(
//     "notifications",
//     require("./components/Notifications.vue").default
// );
// Vue.component("admin-ticket", require("./pages/AdminTicket.vue").default);
// Vue.component("ticket", require("./pages/Ticket.vue").default);
// Vue.component("ticket-list", require("./pages/TicketList.vue").default);
//
// Vue.config.ignoredElements = ["trix-editor"];
//
// Vue.component("upload-service", {
//     data() {
//         return {
//             showUpdateButton: false,
//             user: [],
//         };
//     },
//
//     methods: {
//         onChange() {
//             this.showUpdateButton = true;
//         },
//     },
// });
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
//
// const app = new Vue({
//     el: "#app",
//
//     data: {
//         isOpen: false,
//     },
//
//     watch: {
//         isOpen(isOpen) {
//             if (isOpen) {
//                 document.addEventListener("click", this.closeMenu);
//             }
//         },
//     },
//
//     methods: {
//         closeMenu(event) {
//             if (!event.target.closest("header")) {
//                 this.isOpen = false;
//             }
//         },
//
//         persianReplace(str = "") {
//             let persianNumberArr = [
//                 /۰/g,
//                 /۱/g,
//                 /۲/g,
//                 /۳/g,
//                 /۴/g,
//                 /۵/g,
//                 /۶/g,
//                 /۷/g,
//                 /۸/g,
//                 /۹/g,
//             ];
//             let arabicNumberArr = [
//                 /٠/g,
//                 /١/g,
//                 /٢/g,
//                 /٣/g,
//                 /٤/g,
//                 /٥/g,
//                 /٦/g,
//                 /٧/g,
//                 /٨/g,
//                 /٩/g,
//             ];
//
//             let englishNumberArr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
//
//             if (str.length === 0) {
//                 return str;
//             }
//
//             for (let i = 0; i < 10; i++) {
//                 str = str
//                     .replace(persianNumberArr[i], englishNumberArr[i])
//                     .replace(arabicNumberArr[i], englishNumberArr[i]);
//             }
//
//             return str;
//         },
//
//         sanitizeNumber(e) {
//             e.target.value = this.persianReplace(e.target.value);
//         },
//     },
//
//     // changeToEnglish(e) {
//     //     let str = e.target.value;
//     //
//     //     let persianNumberArr = [/۰/g, /۱/g, /۲/g, /۳/g, /۴/g, /۵/g, /۶/g, /۷/g, /۸/g, /۹/g];
//     //     let arabicNumberArr = [/٠/g, /١/g, /٢/g, /٣/g, /٤/g, /٥/g, /٦/g, /٧/g, /٨/g, /٩/g];
//     //
//     //     let englishNumberArr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
//     //
//     //     if (str.length === 0) {
//     //         return str;
//     //     }
//     //
//     //     for (let i = 0; i < 10; i++) {
//     //         str = str.replace(persianNumberArr[i], englishNumberArr[i])
//     //             .replace(arabicNumberArr[i], englishNumberArr[i]);
//     //     }
//     //
//     //     e.target.value = str;
//     // }
// });
