require('./bootstrap');

window.Vue = require('vue');

//table
import PesertaTable from './components/tables/peserta-table';
import DataKesehatanTable from './components/tables/data-kesehatan-table';

//form
import DataPesertaForm from './components/forms/data-peserta-form';
import DataKesehatanForm from './components/forms/data-kesehatan-form';

// modal
import DeleteModal from './components/modals/delete-modal';
import LoadingModal from './components/modals/loading-modal';
import SuccessModal from './components/modals/success-modal';
import PesertaTableModal from './components/modals/peserta-table-modal'

// external plugin
import VueDatepicker from 'vue-date-pick';
import VModal from 'vue-js-modal'
import SweetAlertIcons from 'vue-sweetalert-icons';
import VuePagination from 'vuejs-paginate'

Vue.component('peserta-table', PesertaTable);
Vue.component('data-kesehatan-table', DataKesehatanTable);

Vue.component('data-peserta-form', DataPesertaForm);
Vue.component('data-kesehatan-form', DataKesehatanForm);

Vue.component('delete-modal', DeleteModal);
Vue.component('loading-modal', LoadingModal);
Vue.component('success-modal', SuccessModal);
Vue.component('peserta-table-modal', PesertaTableModal);

Vue.component('vue-datepicker', VueDatepicker);
Vue.component('vue-pagination', VuePagination)

Vue.use(VModal);
Vue.use(SweetAlertIcons);
const app = new Vue({
  el: '#app',
});