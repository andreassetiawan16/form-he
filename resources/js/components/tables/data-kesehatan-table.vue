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

    <!-- search peserta -->
    <div class="card">
      <div class="head-content-section">
        <h3>Data Kesehatan Peserta</h3>
        <a class="btn btn-info" :href="urlAddDataKesehatan">Tambah</a>
      </div>
      <div class="form-group">
        <label for="nama">Cari Peserta</label>
        <div class="input-group">
          <vue-select :options="pesertas" label="nama" @search="searchPeserta" :clearable="false" :value="peserta.nama" @input="selectPeserta"></vue-select>
          <div class="input-group-addon clickable" @click="showTablePesertaModal"><i class="fa fa-search"></i></div>
        </div>
      </div>
    </div>
    <!-- end search peserta -->

    <!-- table data kesehatan -->
    <div class="box box-info" v-if="peserta.nama !== null">
      <div class="container-fluid">
        <vuetable ref="data_kesehatan_table"
                  :api-url="tempUrl"
                  :fields="fields"
                  :per-page="10"
                  pagination-path=""
                  @vuetable:pagination-data="onPaginationData"
        >
          <template slot="tanggal" slot-scope="props">
            <a :href="urlDataKesehatan + props.rowData.id + '/edit'">{{ props.rowData.tanggal_he.substring(0, 10) }}</a>
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
      </div>
    </div>
    <!-- end table data kesehatan -->

    
    <!-- <div v-if="listDataKesehatan.length > 0">
      <div class="card grow clickable" v-for="(dataKesehatan, i) in listDataKesehatan" :key="i">
        <div class="form-group">
          <h4>Tanggal He : {{ dataKesehatan.tanggal_he.substring(0, 10) }}</h4>
        </div>
        <div class="row form-group">
          <div class="col-sm-3">Tensi Sistol : </div>
          <div class="col-sm-9">{{ dataKesehatan.tensi_sistol }} mmHg</div>
        </div>
        <div class="row form-group">
          <div class="col-sm-3">Tensi Diastol : </div>
          <div class="col-sm-9">{{ dataKesehatan.tensi_diastol }} mmHg</div>
        </div>
        <div class="row form-group">
          <div class="col-sm-3">Asam Urat</div>
          <div class="col-sm-9">{{ dataKesehatan.asam_urat }} mg/dl</div>
        </div>
        <div class="row form-group">
          <div class="col-sm-3">Gula Darah</div>
          <div class="col-sm-9">{{ dataKesehatan.gula_darah }} mg/dl</div>
        </div>
        <div class="row form-group">
          <div class="col-sm-3">Kolestrol</div>
          <div class="col-sm-9">{{ dataKesehatan.kolestrol }} mg/dl</div>
        </div>
        <div class="row form-group">
          <div class="col-sm-3">Lingkar Perut</div>
          <div class="col-sm-9">
            <div class="row">
              <div class="col-sm-6">{{ dataKesehatan.hasil_lingkar_perut }} cm (Hasil)</div>
              <div class="col-sm-6">{{ dataKesehatan.nilai_rujukan_lingkar_perut }} cm (Nilai Rujukan)</div>
            </div>
          </div>
        </div>
        <div class="row form-group">
          <div class="col-sm-3">Berat Badan (Status : {{ dataKesehatan.status_berat_badan }})</div>
          <div class="col-sm-9">
            <div class="row">
              <div class="col-sm-6">{{ dataKesehatan.hasil_berat_badan }} kg</div>
              <div class="col-sm-6">{{ dataKesehatan.nilai_rujukan_berat_badan }} kg</div>
            </div>
          </div>
        </div>
        <div class="row form-group">
          <div class="col-sm-3">Lemak Tubuh (Angka, +/-)</div>
          <div class="col-sm-9">
            <div class="row">
              <div class="col-sm-6">{{ dataKesehatan.angka_lemak_tubuh }} kg</div>
              <div class="col-sm-6">{{ dataKesehatan.perbandingan_standar_lemak_tubuh }}</div>
            </div>
          </div>
        </div>
        <div class="row form-group">
          <div class="col-sm-3">Indeks Masa Tubuh (BMI = BB/T <sup>2</sup>)</div>
          <div class="col-sm-9">{{ dataKesehatan.indeks_masa_tubuh }} kg/m<sup>2</sup></div>
        </div>
        <div class="row form-group">
          <div class="col-sm-3">Lemak Lapisan Organ (Angka, +/-)</div>
          <div class="col-sm-9">
            <div class="row">
              <div class="col-sm-6">{{ dataKesehatan.angka_lemak_lapisan_organ }} %</div>
              <div class="col-sm-6">{{ dataKesehatan.perbandingan_standar_lemak_lapisan_organ }}</div>
            </div>
          </div>
        </div>
        <div class="row form-group">
          <div class="col-sm-3">Resting Metabilsm</div>
          <div class="col-sm-9">
            <div class="row">
              <div class="col-sm-6">{{ dataKesehatan.hasil_resting_metabolism }} (Hasil)</div>
              <div class="col-sm-6">{{ dataKesehatan.nilai_rujukan_resting_metabolism }} (Nilai Rujukan)</div>
            </div>
          </div>
        </div>
        <div class="row form-group">
          <div class="col-sm-3">Usia Tubuh</div>
          <div class="col-sm-9">
            <div class="row">
              <div class="col-sm-6">{{ dataKesehatan.hasil_usia_tubuh }} Thn (Hasil)</div>
              <div class="col-sm-6">{{ dataKesehatan.nilai_rujukan_usia_tubuh }} Thn (Nilai Rujukan)</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="text-center" style="margin-top:20px" v-else>Tidak ada Data Kesehatan</div>

    <vue-pagination v-model="pagination.page"
                    :pageCount="pagination.total"
                    :margin-pages="5"
                    :clickHandler="changePage"
                    container-class="pagination"
                    prev-text="<i class='fa fa-chevron-left'></i>"
                    next-text="<i class='fa fa-chevron-right'></i>"
                    v-if="listDataKesehatan.length > 0"
    /> -->
  </div>
</template>
<script>
import axios from 'axios'
import vueSelect from 'vue-select'
import Vuetable from 'vuetable-2/src/components/Vuetable'
import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'
import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'
export default {
  components: {
    Vuetable,
    VuetablePagination,
    VuetablePaginationInfo,
    vueSelect
  },
  props: {
    url: {
      type: String
    }
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
      // pagination: {
      //   page: 1,
      //   total: 0
      // },
      urlDataKesehatan: process.env.MIX_BASE_URL + '/data-kesehatan/',
      urlAddDataKesehatan: process.env.MIX_BASE_URL + '/data-kesehatan/create',
      tempUrl: '',
      selectedDataKesehatan: {},
      listDataKesehatan: []
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
    // async loadDataKesehatan (page) {
      // let response = await axios({
      //   method: 'GET',
      //   url: process.env.MIX_BASE_URL + '/tableDataKesehatan/' + this.peserta.id + '?page=' + page
      // })
      // this.listDataKesehatan = Object.assign([], response.data.data)
      // this.pagination.page = response.data.current_page
      // this.pagination.total = response.data.last_page
    // },
    selectPeserta (peserta) {
      this.$modal.hide('peserta-table-modal')
      this.peserta = peserta
      this.tempUrl = this.url + '/' + this.peserta.id + '?'
      // this.loadDataKesehatan(1)
    },
    // changePage () {
    //   this.loadDataKesehatan(this.pagination.page + 1)
    // },
    showTablePesertaModal () {
      this.$modal.show('peserta-table-modal')
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
    }
  },
  created () {
    this.tempUrl = this.url
  }
}
</script>