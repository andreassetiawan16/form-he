require('./bootstrap');

window.Vue = require('vue');
import CustomVuetable from './components/Vuetable.vue';
import DataPesertaForm from './components/data-peserta-form';

Vue.component('custom-vuetable', CustomVuetable);
Vue.component('data-peserta-form', DataPesertaForm);

const app = new Vue({
  el: '#app',
});