<template>
  <div class="container-fluid">
    <loading-modal />

    <success-modal>Berhasil membuat Staff</success-modal>

    <div class="head-content-section">
      <h3>Create Data Staff</h3>
    </div>

    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" class="form-control input-text" :class="getErrorMessage('nama')" v-model="data.nama">
      <div class="error-message" v-for="(error, i) in errorMessage.nama" :key="i">{{ error }}</div>
    </div>
    <div class="form-group">
      <label for="posisi">Posisi</label>
      <select class="form-control input-text" :class="getErrorMessage('posisi')" v-model="data.posisi">
        <option>Dokter</option>
        <option>Petugas</option>
      </select>
      <div class="error-message" v-for="(error, i) in errorMessage.posisi" :key="i">{{ error }}</div>
    </div>
    <div class="form-group">
      <label for="Email">Email</label>
      <input type="email" class="form-control input-text" :class="getErrorMessage('email')" v-model="data.email">
      <div class="error-message" v-for="(error, i) in errorMessage.email" :key="i">{{ error }}</div>
    </div>
    <div class="form-group">
      <label for="Nomor Whatsapp" class="required">Nomor Whatsapp</label>
      <input type="number" class="form-control input-text" :class="getErrorMessage('no_wa')" v-model="data.no_wa">
      <div class="error-message" v-for="(error, i) in errorMessage.usia" :key="i">{{ error }}</div>
    </div>
    <div class="form-group">
      <label for="Nomor Telepon">Nomor Telepon</label>
      <input type="number" class="form-control input-text" :class="getErrorMessage('no_telepon')" v-model="data.no_telepon">
      <div class="error-message" v-for="(error, i) in errorMessage.no_telepon" :key="i">{{ error }}</div>
    </div>
    <div class="form-group">
      <label for="Jenis Kelamin" class="required">Jenis Kelamin</label>
      <select class="form-control input-text" :class="getErrorMessage('jenis_kelamin')" v-model="data.jenis_kelamin">
        <option>Laki-laki</option>
        <option>Perempuan</option>
      </select>
      <div class="error-message" v-for="(error, i) in errorMessage.jenis_kelamin" :key="i">{{ error }}</div>
    </div>
    <div class="form-group">
      <label for="Tinggi">Tinggi</label>
      <input type="number" class="form-control input-text" :class="getErrorMessage('tinggi')" v-model="data.tinggi">
      <div class="error-message" v-for="(error, i) in errorMessage.tinggi" :key="i">{{ error }}</div>
    </div>
    <div class="form-group">
      <label for="Tempat Lahir" class="required">Tempat Lahir</label>
      <input type="text" class="form-control input-text" :class="getErrorMessage('tempat_lahir')" v-model="data.tempat_lahir">
      <div class="error-message" v-for="(error, i) in errorMessage.tempat_lahir" :key="i">{{ error }}</div>
    </div>
    <div class="form-group">
      <label for="Tanggal Lahir" class="required">Tanggal Lahir</label>
      <vue-datepicker v-model="data.tanggal_lahir" :class="getErrorMessage('tanggal_lahir')" />
      <div class="error-message" v-for="(error, i) in errorMessage.tanggal_lahir" :key="i">{{ error }}</div>
    </div>
    <div class="form-group">
      <label for="Alamat">Alamat</label>
      <input type="text" class="form-control input-text" :class="getErrorMessage('alamat')" v-model="data.alamat">
      <div class="error-message" v-for="(error, i) in errorMessage.alamat" :key="i">{{ error }}</div>
    </div>
    <button class="btn btn-info" @click="createStaff">Save</button>
  </div>
</template>

<script>
import axios from 'axios'
import vueSelect from 'vue-select'
export default {
  data () {
    return {
      data: {
        nama: null,
        posisi: 'Dokter',
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
    async createStaff () {
      this.$modal.show('loading-modal')
      let response = await axios({
        method: 'POST',
        url: process.env.MIX_BASE_URL + '/staff/store',
        data: this.data
      })
      if (response.data.status === 200) {
        setTimeout(() => {
          this.$modal.hide('loading-modal')
          this.$modal.show('success-modal')
          setTimeout(() => {
            this.$modal.hide('success-modal')
            window.location = '/staff'
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