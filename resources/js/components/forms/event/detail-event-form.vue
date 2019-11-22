<template>
  <div class="container-fluid">
    <!-- edit form -->
    <div class="head-content-section">
      <h3>Data Event</h3>
      <a :href="urlEditEvent + event.id + '/edit'" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
    </div>
    <div class="row form-group">
      <div class="col-sm-3">Tanggal Event</div>
      <div class="col-sm-9">{{ event.tanggal_event }}</div>
    </div>
    <div class="row form-group">
      <div class="col-sm-3">Pembicara</div>
      <div class="col-sm-9">{{ event.pembicara }}</div>
    </div>
    <div class="row form-group">
      <div class="col-sm-3">Topik</div>
      <div class="col-sm-9">{{ event.topik }}</div>
    </div>
    <div class="row form-group">
      <div class="col-sm-3">Jumlah Peserta</div>
      <div class="col-sm-9">{{ event.jumlah_peserta }}</div>
    </div>
  </div>
</template>
<script>
import axios from 'axios';
export default {
  props: ['dataevent'],
  data () {
    return {
      urlEditEvent: process.env.MIX_BASE_URL + '/event/',
      event: {}
    }
  },
  created () {
    this.event = Object.assign({}, JSON.parse(this.dataevent))
  }
}
</script>