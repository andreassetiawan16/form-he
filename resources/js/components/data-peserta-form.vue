<template>
  <div class="container-fluid">
    <div class="form-group">
      <label for="nama" class="required">Nama</label>
      <input type="email" class="form-control input-text" :class="getErrorMessage('nama')" v-model="peserta.nama">
      <div class="error-message" v-for="(error, i) in errorMessage.nama" :key="i">{{ error }}</div>
    </div>
    <div class="form-group">
      <label for="Usia" class="required">Usia</label>
      <input type="number" class="form-control input-text" :class="getErrorMessage('usia')" v-model="peserta.usia">
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
      <input type="date" class="form-control input-text" :class="getErrorMessage('tanggal_lahir')" v-model="peserta.tanggal_lahir">
      <div class="error-message" v-for="(error, i) in errorMessage.tanggal_lahir" :key="i">{{ error }}</div>
    </div>
    <div class="form-group">
      <label for="Alamat" class="required">Alamat</label>
      <input type="text" class="form-control input-text" :class="getErrorMessage('alamat')" v-model="peserta.alamat">
      <div class="error-message" v-for="(error, i) in errorMessage.alamat" :key="i">{{ error }}</div>
    </div>
    <!-- conton search peserta -->
    <div class="form-group">
      <vue-select :options="pesertas" label="nama" @search="searchPeserta" :clearable="false"></vue-select>
    </div>
    <button class="btn btn-primary" @click="createPeserta">Save</button>
    <!-- conton search peserta -->
  </div>
</template>
<script>
import axios from 'axios'
import vueSelect from 'vue-select'
export default {
  props: ['proppeserta', 'isedit'],
  components: {
    vueSelect
  },
  data () {
    return {
      peserta: {
        nama: null,
        usia: null,
        jenis_kelamin: null,
        tinggi: null,
        tempat_lahir: null,
        tanggal_lahir: null,
        alamat: null
      },
      errorMessage: {},
      pesertas: [],
    }
  },
  methods: {
    async createPeserta () {
      let response = ''
      if (!this.isedit) {
        response = await axios({
            method: 'POST',
            url: 'store',
            data: this.peserta
        })
      } else {
        let payload = Object.assign({}, this.peserta)
        delete payload.id
        response = await axios({
          method: 'POST',
          url: 'update',
          data: payload
        })
      }
      if (response.data.status === 200) {
        window.location = '/data-peserta/'
      } else {
        this.errorMessage = Object.assign({}, response.data.message)
      }
    },
    getErrorMessage (field) {
      if (this.errorMessage[field] && this.errorMessage[field].length > 0) {
        return 'error'
      }
    },
    searchPeserta (search, loading) {
      fetch ('/data-peserta/search?query=' + search)
      .then(res => {
        res.json()
        .then(json => (this.pesertas = json.data));
      })
    }
  },
  mounted () {
    if (this.proppeserta) {
      this.peserta = Object.assign({}, JSON.parse(this.proppeserta))
      this.peserta.tanggal_lahir = this.peserta.tanggal_lahir.substring(0, 10)
    }
    this.searchPeserta('', true)
  }
}
</script>