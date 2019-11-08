require('./bootstrap');

window.Vue = require('vue');
import CustomVuetable from './components/Vuetable.vue';
import DataPesertaForm from './components/data-peserta-form';
import DataKesehatanForm from './components/data-kesehatan-form';

Vue.component('custom-vuetable', CustomVuetable);
Vue.component('data-peserta-form', DataPesertaForm);
Vue.component('data-kesehatan-form', DataKesehatanForm);

const app = new Vue({
  el: '#app',
});