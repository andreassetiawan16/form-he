<template>
  <div class="container-fluid">
    {{peserta}}
    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="email" class="form-control input-text" v-model="peserta.nama">
    </div>
    <div class="form-group">
      <label for="Usia">Usia</label>
      <input type="number" class="form-control input-text" v-model="peserta.usia">
    </div>
    <div class="form-group">
      <label for="Jenis Kelamin">Jenis Kelamin</label>
      <select class="form-control input-text" v-model="peserta.jenis_kelamin">
        <option>Laki-laki</option>
        <option>Perempuan</option>
      </select>
    </div>
    <div class="form-group">
      <label for="Tinggi">Tinggi</label>
      <input type="number" class="form-control input-text" v-model="peserta.tinggi">
    </div>
    <div class="form-group">
      <label for="Tempat Lahir">Tempat Lahir</label>
      <input type="text" class="form-control input-text" v-model="peserta.tempat_lahir">
    </div>
    <div class="form-group">
      <label for="Tanggal Lahir">Tanggal Lahir</label>
      <input type="text" class="form-control input-text" v-model="peserta.tanggal_lahir">
    </div>
    <div class="form-group">
      <label for="Alamat">Alamat</label>
      <input type="text" class="form-control input-text" v-model="peserta.alamat">
    </div>
    <button class="btn btn-primary" @click="createPeserta">Save</button>
  </div>
</template>
<script>
import axios from 'axios'
export default {
  data () {
    return {
      peserta: {
        nama: '',
        usia: '',
        jenis_kelamin: '',
        tinggi: '',
        tempat_lahir: '',
        tanggal_lahir: '',
        alamat: ''
      }
    }
  },
  methods: {
    async createPeserta () {
      let response = await axios({
          method: 'POST',
          url: 'store',
          data: this.peserta
      })
      console.log('pserta : ', response)
    }
  }
}
</script>