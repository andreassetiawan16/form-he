require('./bootstrap');

window.Vue = require('vue');
import PesertaTable from './components/peserta-table';
import DataKesehatanTable from './components/data-kesehatan-table';
import DataPesertaForm from './components/data-peserta-form';
import DataKesehatanForm from './components/data-kesehatan-form';
import VModal from 'vue-js-modal'
import SweetAlertIcons from 'vue-sweetalert-icons';

Vue.component('peserta-table', PesertaTable);
Vue.component('data-kesehatan-table', DataKesehatanTable);
Vue.component('data-peserta-form', DataPesertaForm);
Vue.component('data-kesehatan-form', DataKesehatanForm);
Vue.use(VModal);
Vue.use(SweetAlertIcons);
const app = new Vue({
  el: '#app',
});