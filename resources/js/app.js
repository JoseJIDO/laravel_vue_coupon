/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


 import Vue from 'vue'
 import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
 import Swal from 'sweetalert2';

require('./bootstrap');
window.Vue = require('vue');

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// import commns functions project
import common from './commons/commons.js'

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)


Vue.mixin(common)

Vue.component('coupon-component', require('./components/adm/CouponComponent.vue').default);
Vue.component('load-component', require('./components/utils/LoadComponent.vue').default);
Vue.component('navbar-component', require('./components/utils/NavBarComponent.vue').default);


window.Toast = Swal.mixin({
    toast: true,
    position: 'top-right',
    timer: 3000,
    timerProgressBar: true
});


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
