require('./bootstrap');

window.Vue = require('vue');

//table
import PesertaTable from './components/tables/peserta-table';
import DataKesehatanTable from './components/tables/data-kesehatan-table';
import EventTable from './components/tables/event-table';
import StaffTable from './components/tables/staff-table';

//form data kesehatan
import CreateDataKesehatanForm from './components/forms/data-kesehatan/create-data-kesehatan-form'
import DetailDataKesehatanForm from './components/forms/data-kesehatan/detail-data-kesehatan-form';
import EditDataKesehatanForm from './components/forms/data-kesehatan/edit-data-kesehatan-form';

// form data peserta
import DetailDataPesertaForm from './components/forms/data-peserta/detail-data-peserta-form';
import CreateDataPesertaForm from './components/forms/data-peserta/create-data-peserta-form';
import EditDataPesertaForm from './components/forms/data-peserta/edit-data-peserta-form';

// form event
import CreateEventForm from './components/forms/event/create-event-form';
import DetailEventForm from './components/forms/event/detail-event-form';
import EditEventForm from './components/forms/event/edit-event-form';

//form staff
import CreateStaffForm from './components/forms/staff/create-staff-form';
import DetailStaffForm from './components/forms/staff/detail-staff-form';
import EditStaffForm from './components/forms/staff/edit-staff-form';

// index staff
import IndexStaff from './components/index-staff';

// modal
import DeleteModal from './components/modals/delete-modal';
import LoadingModal from './components/modals/loading-modal';
import SuccessModal from './components/modals/success-modal';
import PesertaTableModal from './components/modals/peserta-table-modal';
import StaffTableModal from './components/modals/staff-table-modal';

// external plugin
import VueDatepicker from 'vue-date-pick';
import VModal from 'vue-js-modal';
import SweetAlertIcons from 'vue-sweetalert-icons';
import VuePagination from 'vuejs-paginate';
import { ToggleButton } from 'vue-js-toggle-button'

Vue.component('peserta-table', PesertaTable);
Vue.component('data-kesehatan-table', DataKesehatanTable);
Vue.component('event-table', EventTable);
Vue.component('staff-table', StaffTable);

// form data kesehatan
Vue.component('create-data-kesehatan-form', CreateDataKesehatanForm);
Vue.component('edit-data-kesehatan-form', EditDataKesehatanForm);
Vue.component('detail-data-kesehatan-form', DetailDataKesehatanForm);

// form data peserta
Vue.component('detail-data-peserta-form', DetailDataPesertaForm);
Vue.component('create-data-peserta-form', CreateDataPesertaForm);
Vue.component('edit-data-peserta-form', EditDataPesertaForm);

// form staff
Vue.component('create-staff-form', CreateStaffForm);
Vue.component('detail-staff-form', DetailStaffForm);
Vue.component('edit-staff-form', EditStaffForm);

// form event
Vue.component('create-event-form', CreateEventForm);
Vue.component('detail-event-form', DetailEventForm);
Vue.component('edit-event-form', EditEventForm);

// index staff
Vue.component('index-staff', IndexStaff)

Vue.component('delete-modal', DeleteModal);
Vue.component('loading-modal', LoadingModal);
Vue.component('success-modal', SuccessModal);
Vue.component('peserta-table-modal', PesertaTableModal);
Vue.component('staff-table-modal', StaffTableModal)

Vue.component('vue-datepicker', VueDatepicker);
Vue.component('vue-pagination', VuePagination);
Vue.component('toggle-button', ToggleButton);

Vue.use(VModal);
Vue.use(SweetAlertIcons);
const app = new Vue({
  el: '#app',
});