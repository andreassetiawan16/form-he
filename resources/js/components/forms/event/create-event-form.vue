<template>
  <div class="container-fluid">
    <loading-modal />

    <success-modal>
      Berhasil membuat event baru
    </success-modal>

    <!-- edit form -->
    <div class="head-content-section">
      <h3>Create Data Event</h3>
    </div>
    <div class="form-group">
      <label for="tanggal_event" class="required">Tanggal Event</label>
      <vue-datepicker v-model="event.tanggal_event" :format="'YYYY-MM-DD HH:mm'" :pickTime="true" :class="getErrorMessage('tanggal_event')" />
      <div class="error-message" v-for="(error, i) in errorMessage.tanggal_event" :key="i">{{ error }}</div>
    </div>
    <div class="form-group">
      <label for="pembicara">Pembicara</label>
      <input type="text" class="form-control input-text" :class="getErrorMessage('pembicara')" v-model="event.pembicara">
      <div class="error-message" v-for="(error, i) in errorMessage.pembicara" :key="i">{{ error }}</div>
    </div>
    <div class="form-group">
      <label for="topik">Topik</label>
      <input type="text" class="form-control input-text" :class="getErrorMessage('topik')" v-model="event.topik">
      <div class="error-message" v-for="(error, i) in errorMessage.topik" :key="i">{{ error }}</div>
    </div>
    <div class="form-group">
      <label for="jumlah_peserta" class="required">Jumlah Peserta</label>
      <input type="number" class="form-control input-text" :class="getErrorMessage('jumlah_peserta')" v-model="event.jumlah_peserta">
      <div class="error-message" v-for="(error, i) in errorMessage.jumlah_peserta" :key="i">{{ error }}</div>
    </div>
    <button class="btn btn-info" @click="createEvent">Save</button>
  </div>
</template>
<script>
import axios from 'axios';
export default {
  data () {
    return {
      event: {
        pembicara: null,
        topik: null,
        tanggal_event: null,
        jumlah_peserta: null
      },
      errorMessage: {},
    }
  },
  methods: {
    async createEvent () {
      this.$modal.show('loading-modal')
      let response = await axios({
        method: 'POST',
        url: process.env.MIX_BASE_URL + '/event/store',
        data: this.event
      })
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
    }
  }
}
</script>