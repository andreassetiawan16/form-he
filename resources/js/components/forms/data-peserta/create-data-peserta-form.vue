<template>
  <div class="container-fluid">
    <loading-modal />

    <success-modal>
      Berhasil membuat data peserta baru
    </success-modal>

    <div class="head-content-section">
      <h3>Create Data Peserta</h3>
    </div>
    <div class="form-group">
      <label for="nama" class="required">Nama</label>
      <input type="email" class="form-control input-text" :class="getErrorMessage('nama')" v-model="peserta.nama">
      <div class="error-message" v-for="(error, i) in errorMessage.nama" :key="i">{{ error }}</div>
    </div>
    <div class="form-group">
      <label for="Email" class="required">Email</label>
      <input type="email" class="form-control input-text" :class="getErrorMessage('email')" v-model="peserta.email">
      <div class="error-message" v-for="(error, i) in errorMessage.email" :key="i">{{ error }}</div>
    </div>
    <div class="form-group">
      <label for="Nomor Telepon" class="required">Nomor Telepon</label>
      <input type="number" class="form-control input-text" :class="getErrorMessage('no_telepon')" v-model="peserta.no_telepon">
      <div class="error-message" v-for="(error, i) in errorMessage.no_telepon" :key="i">{{ error }}</div>
    </div>
    <div class="form-group">
      <label for="Nomor Whatsapp">Nomor Whatsapp</label>
      <input type="number" class="form-control input-text" :class="getErrorMessage('no_wa')" v-model="peserta.no_wa">
      <div class="error-message" v-for="(error, i) in errorMessage.usia" :key="i">{{ error }}</div>
    </div>
    <div class="form-group">
      <label for="Jenis Kelamin" class="required">Jenis Kelamin</label>
      <select class="form-control input-text" :class="getErrorMessage('jenis_kelamin')" v-model="peserta.jenis_kelamin">
        <option>Laki-laki</option>
        <option>Perempuan</option>
      </select>
      <div class="error-message" v-for="(error, i) in errorMessage.jenis_kelamin" :key="i">{{ error }}</div>
    </div>
    <div class="form-group">
      <label for="Tinggi" class="required">Tinggi</label>
      <input type="number" class="form-control input-text" :class="getErrorMessage('tinggi')" v-model="peserta.tinggi">
      <div class="error-message" v-for="(error, i) in errorMessage.tinggi" :key="i">{{ error }}</div>
    </div>
    <div class="form-group">
      <label for="Tempat Lahir" class="required">Tempat Lahir</label>
      <input type="text" class="form-control input-text" :class="getErrorMessage('tempat_lahir')" v-model="peserta.tempat_lahir">
      <div class="error-message" v-for="(error, i) in errorMessage.tempat_lahir" :key="i">{{ error }}</div>
    </div>
    <div class="form-group">
      <label for="Tanggal Lahir" class="required">Tanggal Lahir</label>
      <vue-datepicker v-model="peserta.tanggal_lahir" :class="getErrorMessage('tanggal_lahir')" />
      <div class="error-message" v-for="(error, i) in errorMessage.tanggal_lahir" :key="i">{{ error }}</div>
    </div>
    <div class="form-group">
      <label for="Alamat" class="required">Alamat</label>
      <input type="text" class="form-control input-text" :class="getErrorMessage('alamat')" v-model="peserta.alamat">
      <div class="error-message" v-for="(error, i) in errorMessage.alamat" :key="i">{{ error }}</div>
    </div>
    <button class="btn btn-info" @click="createPeserta">Save</button>

  </div>
</template>
<script>
import axios from 'axios'
import vueSelect from 'vue-select'
export default {
  data () {
    return {
      peserta: {
        nama: null,
        email: null,
        no_telepon: null,
        no_wa: null,
        jenis_kelamin: null,
        tinggi: null,
        tempat_lahir: null,
        tanggal_lahir: null,
        alamat: null
      },
      errorMessage: {}
    }
  },
  methods: {
    async createPeserta () {
      this.$modal.show('loading-modal')
      let response = await axios({
        method: 'POST',
        url: process.env.MIX_BASE_URL + '/data-peserta/store',
        data: this.peserta
      })
      if (response.data.status === 200) {
        setTimeout(() => {
          this.$modal.hide('loading-modal')
          this.$modal.show('success-modal')
          setTimeout(() => {
            this.$modal.hide('success-modal')
            window.location = '/data-peserta/'
          }, 2000)
        }, 2000)
      } else {
        setTimeout(() => {
          this.$modal.hide('loading-modal')
          this.errorMessage = Object.assign({}, response.data.message)
        }, 2000)
      }
    },
    getErrorMessage (field) {
      if (this.errorMessage[field] && this.errorMessage[field].length > 0) {
        return 'error'
      }
    }
  }
}
</script>