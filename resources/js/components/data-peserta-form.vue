<template>
  <div class="container-fluid">
    <modal name="loading-modal" :width="500">
      <sweetalert-icon icon="loading" />
      <h4 class="text-center">Loading</h4>
    </modal>

    <!-- detail form -->
    <template v-if="isShow">
      <div class="form-action" @click="editForm"><button class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</button></div>
      <div class="row form-group">
        <div class="col-sm-3">
          <div>Nama</div>
        </div>
        <div class="col-sm-9">: {{ peserta.nama }}</div>
      </div>
      <div class="row form-group">
        <div class="col-sm-3">
          <div>Usia</div>
        </div>
        <div class="col-sm-9">: {{ peserta.usia }} Tahun</div>
      </div>
      <div class="row form-group">
        <div class="col-sm-3">
          <div>Jenis Kelamin</div>
        </div>
        <div class="col-sm-9">: {{ peserta.jenis_kelamin }}</div>
      </div>
      <div class="row form-group">
        <div class="col-sm-3">
          <div>Tinggi</div>
        </div>
        <div class="col-sm-9">: {{ peserta.tinggi }} cm</div>
      </div>
      <div class="row form-group">
        <div class="col-sm-3">
          <div>Tempat Lahir</div>
        </div>
        <div class="col-sm-9">: {{ peserta.tempat_lahir }}</div>
      </div>
      <div class="row form-group">
        <div class="col-sm-3">
          <div>Tanggal Lahir</div>
        </div>
        <div class="col-sm-9">: {{ peserta.tanggal_lahir }}</div>
      </div>
      <div class="row form-group">
        <div class="col-sm-3">
          <div>Alamat</div>
        </div>
        <div class="col-sm-9">: {{ peserta.alamat }}</div>
      </div>
    </template>
    <!-- detail form -->

    <!-- edit form -->
    <template v-else>
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
      <button class="btn btn-primary" @click="createPeserta">Save</button>
    </template>
    <!-- edit form -->
  </div>
</template>
<script>
import axios from 'axios'
import vueSelect from 'vue-select'
export default {
  props: ['proppeserta', 'isedit'],
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
      isShow: true
    }
  },
  methods: {
    async createPeserta () {
      let response = ''
      this.$modal.show('loading-modal')
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
        setTimeout(() => {
          this.$modal.hide('loading-modal')
          window.location = '/data-peserta/'
        }, 2000)
      } else {
        this.errorMessage = Object.assign({}, response.data.message)
      }
    },
    getErrorMessage (field) {
      if (this.errorMessage[field] && this.errorMessage[field].length > 0) {
        return 'error'
      }
    },
    editForm () {
      this.isShow = false
    }
  },
  mounted () {
    if (this.proppeserta) {
      this.peserta = Object.assign({}, JSON.parse(this.proppeserta))
      this.peserta.tanggal_lahir = this.peserta.tanggal_lahir.substring(0, 10)
    }
    if (!this.isedit) {
      this.isShow = false
    }
  }
}
</script>