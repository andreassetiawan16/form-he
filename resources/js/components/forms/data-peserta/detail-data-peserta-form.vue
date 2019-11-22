<template>
  <div class="container-fluid">

    <!-- detail form -->
    <div class="head-content-section">
      <h3>Data Peserta {{ peserta.nama }}</h3>
      <a :href="urlEditDataPeserta + peserta.id + '/edit'" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
    </div>
    <div class="row form-group">
      <div class="col-sm-3">
        <div>Nama</div>
      </div>
      <div class="col-sm-9">: {{ peserta.nama }}</div>
    </div>
    <div class="row form-group">
      <div class="col-sm-3">
        <div>Email</div>
      </div>
      <div class="col-sm-9">: {{ peserta.email }}</div>
    </div>
    <div class="row form-group">
      <div class="col-sm-3">
        <div>Nomor Telepon</div>
      </div>
      <div class="col-sm-9">: {{ peserta.no_telepon }}</div>
    </div>
    <div class="row form-group">
      <div class="col-sm-3">
        <div>Nomor Whatsapp</div>
      </div>
      <div class="col-sm-9">: {{ peserta.no_wa ? peserta.no_wa : '-' }}</div>
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
    <!-- detail form -->

  </div>
</template>
<script>
import axios from 'axios'
import vueSelect from 'vue-select'
export default {
  props: ['datapeserta'],
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
      urlEditDataPeserta: process.env.MIX_BASE_URL + '/data-peserta/'
    }
  },
  mounted () {
    this.peserta = Object.assign({}, JSON.parse(this.datapeserta))
    this.peserta.tanggal_lahir = this.peserta.tanggal_lahir.substring(0, 10)
  }
}
</script>