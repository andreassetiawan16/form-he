<template>
  <div class="container-fluid">

    <!-- peserta table modal -->
    <peserta-table-modal @selectedPeserta="selectPeserta($event)" />
    <!-- end peserta table modal -->

    <!-- modal delete data kesehatan -->
    <delete-modal modalname="delete-data-kesehatan-modal" :width="500" :height="350" @doDelete="deleteDataKesehatan">
      <template slot="title">Apa anda yakin ingin menghapus data kesehatan {{ peserta.nama }}</template>
    </delete-modal>
    <!-- end modal delete data kesehatan -->

    <div class="box box-info" >
      <div class="container-fluid">

        <!-- filter section -->
        <div class="head-content-section">
          <h3>Data Kesehatan Peserta</h3>
          <a class="btn btn-info" :href="urlAddDataKesehatan">Tambah</a>
        </div>
        <div class="row">
          <div class="col-sm-3">
            <div class="form-group">
              <label for="from date">From Date</label>
              <vue-datepicker @input="setFormDate($event)" :value="fromDate" />
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="from date">To Date</label>
              <template v-if="toDateDisableOption">
                <vue-datepicker v-model="toDate" :isDateDisabled="toDateDisableOption" :value="toDate" />
              </template>
              <template v-else>
                <vue-datepicker v-model="toDate" :value="toDate" />
              </template>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="nama">Cari Peserta</label>
              <div class="input-group">
                <vue-select :options="pesertas" label="nama" @search="searchPeserta" :clearable="false" :value="peserta.nama" @input="selectPeserta"></vue-select>
                <div class="input-group-addon clickable" @click="showTablePesertaModal"><i class="fa fa-search"></i></div>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <button class="btn btn-info" style="margin-top: 20px" @click="filterTable">Filter</button>
          </div>
        </div>
         <!-- end filter section -->

         <!-- table section -->
        <vuetable ref="data_kesehatan_table"
                  :api-url="urlTable"
                  :fields="fields"
                  :per-page="10"
                  pagination-path=""
                  @vuetable:pagination-data="onPaginationData"
        >
          <template slot="tanggal" slot-scope="props">
            <a :href="urlDetailDataKesehatan + props.rowData.id + '/detail'">{{ props.rowData.tanggal_he.substring(0, 10) }}</a>
          </template>
          <template slot="berat_badan" slot-scope="props">
            <div class="text-center">{{ props.rowData.hasil_berat_badan }}kg, {{ props.rowData.nilai_rujukan_berat_badan }} kg</div>
          </template>
          <template slot="lemak_tubuh" slot-scope="props">
            <div class="text-center">{{ props.rowData.angka_lemak_tubuh }}kg, {{ props.rowData.perbandingan_standar_lemak_tubuh }}</div>
          </template>
          <template slot="usia" slot-scope="props">
            <div class="text-center">{{ props.rowData.hasil_usia_tubuh }} Thn, {{ props.rowData.nilai_rujukan_usia_tubuh }} Thn</div>
          </template>
          <div class="vuetable-action" slot="action" slot-scope="props">
            <span class="clickable delete" @click="showDeleteModal(props.rowData)"><i class="fa fa-trash"></i> Delete</span>
          </div>
        </vuetable>

        <div class="vuetable-pagination">

          <vuetable-pagination-info ref="dataKesehatanPaginationInfo"
                                    info-class="pagination-info"
          >
          </vuetable-pagination-info>

          <vuetable-pagination ref="dataKesehatanpagination"
                                :css="css.pagination"
                              @vuetable-pagination:change-page="onChangePage"
          >
          </vuetable-pagination>

        </div>
        <!-- table section -->
      </div>
    </div>

  </div>
</template>
<script>
import axios from 'axios'
import vueSelect from 'vue-select'
import Vuetable from 'vuetable-2/src/components/Vuetable'
import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'
import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'
import { createBrotliCompress } from 'zlib'
export default {
  components: {
    Vuetable,
    VuetablePagination,
    VuetablePaginationInfo,
    vueSelect
  },
  data () {
    return {
      pesertas: [],
      peserta: {
        nama: null,
        usia: null,
        jenis_kelamin: null,
        tinggi: null,
        tempat_lahir: null,
        tanggal_lahir: null,
        alamat: null
      },
      css: {
        pagination: {
          wrapperClass: 'vuetable-pagination',
          activeClass: 'active',
          disabledClass: 'disabled',
          pageClass: 'link-pagination',
          linkClass: '',
          icons: {
            prev: 'fa fa-chevron-left prev',
            next: 'fa fa-chevron-right next'
          }
        }
      },
      fields: [
        {
          name: '__slot:tanggal',
          title: 'Tanggal He',
          sortField: 'tanggal_he'
        },
        {
          name: 'peserta.nama',
          title: 'Nama Pesserta'
        },
        {
          name: '__slot:berat_badan',
          title: 'Berat Badan',
          titleClass: 'text-center'
        },
        {
          name: '__slot:lemak_tubuh',
          title: 'Lemak Tubuh',
          titleClass: 'text-center'
        },
        {
          name: 'indeks_masa_tubuh',
          title: 'Indeks Masa Tubuh',
          titleClass: 'text-center',
          dataClass: 'text-center',
          callback: 'formatIndexMasaTubuh'
        },
        {
          name: '__slot:usia',
          title: 'Usia',
          titleClass: 'text-center'
        },
        {
          name: '__slot:action',
          title: 'Action',
          titleClass: 'text-center'
        }
      ],
      urlDetailDataKesehatan: process.env.MIX_BASE_URL + '/data-kesehatan/',
      urlAddDataKesehatan: process.env.MIX_BASE_URL + '/data-kesehatan/create',
      urlTable: process.env.MIX_BASE_URL + '/tableDataKesehatan/?from_date=&to_date=&peserta_id=',
      tempUrlTable: process.env.MIX_BASE_URL + '/tableDataKesehatan/?',
      selectedDataKesehatan: {},
      listDataKesehatan: [],
      fromDate: '',
      toDate: ''
    }
  },
  methods: {
     searchPeserta (search, loading) {
      fetch ('/data-peserta/search?query=' + search)
      .then(res => {
        res.json()
        .then(json => (this.pesertas = json.data));
      })
    },
    onPaginationData (paginationData) {
      this.$refs.dataKesehatanpagination.setPaginationData(paginationData)
      this.$refs.dataKesehatanPaginationInfo.setPaginationData(paginationData)
    },
    onChangePage (page) {
      this.$refs.data_kesehatan_table.changePage(page)
    },
    formatIndexMasaTubuh (value) {
      return value + ' kg/m<sup>2</sup>'
    },
    selectPeserta (peserta) {
      this.$modal.hide('peserta-table-modal')
      this.peserta = peserta
    },
    showTablePesertaModal () {
      this.$modal.show('peserta-table-modal')
    },
    toDateDisableOption (date) {
      const fromDate = new Date(this.fromDate)
      return date < fromDate
    },
    setFormDate (date) {
      this.fromDate = date
      this.toDate = new Date(date)
      this.toDate.setDate(this.toDate.getDate() + 1)
      this.toDate = this.formatDate(this.toDate).toString()
      this.toDateDisableOption()
    },
    filterTable () {
      this.urlTable = this.tempUrlTable + 'from_date=' + this.fromDate + '&to_date=' + this.toDate + '&peserta_id=' + (this.peserta.id === undefined ? '' : this.peserta.id)
    },
    showDeleteModal (dataKesehatan) {
      this.selectedDataKesehatan = Object.assign({}, dataKesehatan)
      this.$modal.show('delete-data-kesehatan-modal')
    },
    async deleteDataKesehatan () {
      this.$modal.hide('delete-data-kesehatan-modal')
      this.$modal.show('loading-modal')
      let response = await axios ({
        method: 'POST',
        url: process.env.MIX_BASE_URL + '/data-kesehatan/delete',
        data: {id: this.selectedDataKesehatan.id}
      })
      if (response.data.status === 200) {
        setTimeout(() => {
          this.$modal.hide('loading-modal')
          this.$modal.show('success-modal')
          setTimeout(() => {
            this.$modal.hide('success-modal')
            this.refreshTable()
          }, 2000)
        }, 2000)
      }
    },
    formatDate(date) {
      var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear()

      if (month.length < 2) 
        month = '0' + month
      if (day.length < 2) 
        day = '0' + day

      return [year, month, day].join('-')
    }
  }
}
</script>