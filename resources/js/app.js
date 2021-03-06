/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
import Vuex from 'vuex';
import store from './store';
import Multiselect from 'vue-multiselect';
import Vuelidate from 'vuelidate';

Vue.use(Vuelidate)
Vue.use(Vuex);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('form-add-product', require('./components/FormAddProduct.vue').default);
Vue.component('form-edit-product', require('./components/FormEditProduct.vue').default);
Vue.component('ModalImage', require('./components/ModalImage.vue').default);
Vue.component('ImageLibrary', require('./components/ImageLibrary.vue').default);
Vue.component('ImageChoosed', require('./components/ImagesChoosed.vue').default);
Vue.component('multiselect', Multiselect);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store
});
