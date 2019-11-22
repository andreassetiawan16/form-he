<template>
  <div class="container-fluid">
    <loading-modal />

    <success-modal>
      {{isedit ? 'Berhasil update data event' :  'Berhasil membuat data peserta baru'}}
    </success-modal>

    <!-- detail form -->
    <!-- <template v-if="isShow">
      <div class="head-content-section">
        <h3> Data Event </h3>
        <button class="btn btn-info" @click="editForm"><i class="fa fa-pencil"></i> Edit</button>
      </div>
    </template> -->

    <!-- edit form -->
    <template>
      <div class="head-content-section">
        <h3>Data Event</h3>
      </div>
      {{event}}
      <div class="form-group">
        <label for="tanggal_event" class="required">Tanggal Event</label>
        <vue-datepicker v-model="event.tanggal_event" :class="getErrorMessage('tanggal_event')" />
        <div class="error-message" v-for="(error, i) in errorMessage.tanggal_event" :key="i">{{ error }}</div>
      </div>
      <div class="form-group">
        <label for="pembicara">Pembicara</label>
        <input type="text" class="form-control input-text" :class="getErrorMessage('pembicara')" v-model="event.pembicara">
        <div class="error-message" v-for="(error, i) in errorMessage.nama" :key="i">{{ error }}</div>
      </div>
      <div class="form-group">
        <label for="topik">Topik</label>
        <input type="text" class="form-control input-text" :class="getErrorMessage('pembicara')" v-model="event.topik">
        <div class="error-message" v-for="(error, i) in errorMessage.topik" :key="i">{{ error }}</div>
      </div>
      <div class="form-group">
        <label for="jumlah_peserta" class="required">Jumlah Peserta</label>
        <input type="number" class="form-control input-text" :class="getErrorMessage('tinggi')" v-model="event.jumlah_peserta">
        <div class="error-message" v-for="(error, i) in errorMessage.jumlah_peserta" :key="i">{{ error }}</div>
      </div>
      <button class="btn btn-info" @click="createEvent">Save</button>
    </template>
  </div>
</template>
<script>
import axios from 'axios';
export default {
  props:['propevent', 'isedit'],
  data () {
    return {
      event: {
        pembicara: null,
        topik: null,
        tanggal_event: null,
        jumlah_peserta: null
      },
      errorMessage: {},
      isShow: true
    }
  },
  methods: {
    async createEvent () {
      let response = ''
      this.$modal.show('loading-modal')
      if (!this.isedit) {
        response = await axios({
          method: 'POST',
          url: process.env.MIX_BASE_URL + '/event/store',
          data: this.event
        })
      } else {
        console.log('edit :');
      }
      if (response.data.status === 200) {
        setTimeout(() => {
          this.$modal.hide('loading-modal')
          this.$modal.show('success-modal')
          setTimeout(() => {
            this.$modal.hide('success-modal')
            window.location = '/event/'
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
    },
    editForm () {
      this.isShow = false
    }
  }
}
</script>