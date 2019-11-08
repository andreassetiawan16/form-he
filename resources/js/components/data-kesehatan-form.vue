<template>
  <div class="container-fluid">
    {{data}}
    <div class="form-group">
      <label for="tempat_tanggal_he">Tempat, Tanggal Health Expo</label>
      <input type="text" class="form-control input-text" v-model="data.tempat_tanggal_he">
    </div>
    <div class="form-group">
      <label for="Usia">Bab Setiap Hari</label>
      <input type="number" class="form-control input-text" v-model="data.bab_setiap_hari">
    </div>
    <div class="form-group">
      <label for="Usia">Bab Malam Hari</label>
      <input type="number" class="form-control input-text" v-model="data.bab_malam_hari">
    </div>
    <div class="form-group">
      <label for="Usia">Tensi Sistol</label>
      <input type="number" class="form-control input-text" v-model="data.tensi_sistol">
    </div>
    <div class="form-group">
      <label for="Usia">Tensi Diastol</label>
      <input type="number" class="form-control input-text" v-model="data.tensi_diastol">
    </div>
    <div class="form-group">
      <label for="Usia">Asam Urat</label>
      <input type="number" class="form-control input-text" v-model="data.asam_urat">
    </div>
    <div class="form-group">
      <label for="Usia">Gula Darah</label>
      <input type="number" class="form-control input-text" v-model="data.gula_darah">
    </div>
    <div class="form-group">
      <label for="Usia">Kolestrol</label>
      <input type="number" class="form-control input-text" v-model="data.kolestrol">
    </div>
    <div class="form-group">
      <label for="Usia">Hasil Lingkar Perut</label>
      <input type="number" class="form-control input-text" v-model="data.hasil_lingkar_perut">
    </div>
    <div class="form-group">
      <label for="Usia">Hasil Rujukan Lingkar Perut</label>
      <input type="number" class="form-control input-text" v-model="data.hasil_rujukan_lingkar_perut">
    </div>
    <div class="form-group">
      <label for="Usia">Hasil Berat Badan</label>
      <input type="number" class="form-control input-text" v-model="data.hasil_berat_badan">
    </div>
    <div class="form-group">
      <label for="Usia">Nilai Rujukan berat badan</label>
      <input type="number" class="form-control input-text" v-model="data.nilai_rujukan_berat_badan">
    </div>
    <div class="form-group">
      <label for="Usia">Angka Lemak Tubuh</label>
      <input type="number" class="form-control input-text" v-model="data.angka_lemak_tubuh">
    </div>
    <div class="form-group">
      <label for="Usia">Angka Lemak Lapisan Organ</label>
      <input type="number" class="form-control input-text" v-model="data.angka_lemak_lapisan_organ">
    </div>
    <div class="form-group">
      <label for="Usia">Perbandingan Standar Lemak Lapisan Organ</label>
      <input type="number" class="form-control input-text" v-model="data.perbandingan_standar_lemak_lapisan_organ">
    </div>
    <div class="form-group">
      <label for="Usia">Hasil Resting Metabolism</label>
      <input type="number" class="form-control input-text" v-model="data.hasil_resting_metabolism">
    </div>
    <div class="form-group">
      <label for="Usia">Hasil Rujukan Resting Metabolism</label>
      <input type="number" class="form-control input-text" v-model="data.hasil_rujukan_resting_metabolism">
    </div>
    <div class="form-group">
      <label for="Usia">Hasil Usia Tubuh</label>
      <input type="number" class="form-control input-text" v-model="data.hasil_usia_tubuh">
    </div>
    <div class="form-group">
      <label for="Usia">Nilai Rujukan Usia Tubuh</label>
      <input type="number" class="form-control input-text" v-model="data.nilai_rujukan_usia_tubuh">
    </div>
    <div class="form-group">
      <label for="Usia">Keluhan</label>
      <input type="number" class="form-control input-text" v-model="data.keluhan">
    </div>
    <div class="form-group">
      <label for="Usia">Catatan Dokter</label>
      <input type="textarea" class="form-control input-text" v-model="data.catatan_dokter">
    </div>
    <button class="btn btn-primary" @click="crateDataKesehatan">Save</button>
  </div>
</template>
<script>
import axios from 'axios'
export default {
  data () {
    return {
      data: {
        tempat_tanggal_he: '',
        bab_setiap_hari: '',
        bab_malam_hari: '',
        tensi_sistol: '',
        tensi_diastol: '',
        asam_urat: '',
        gula_darah: '',
        kolestrol: '',
        hasil_lingkar_perut: '',
        nilai_rujukan_lingkar_perut: '',
        hasil_berat_badan: '',
        nilai_rujukan_berat_badan: '',
        angka_lemak_tubuh: '',
        perbandingan_standar_lemak_tubuh: '',
        indeks_masa_tubuh: '',
        angka_lemak_lapisan_organ: '',
        perbandingan_standar_lemak_lapisan_organ: '',
        hasil_resting_metabolism: '',
        nilai_rujukan_resting_metabolism: '',
        hasil_usia_tubuh: '',
        nilai_rujukan_usia_tubuh: '',
        keluhan: '',
        catatan_dokter: '',
      }
    }
  },
  methods: {
    async crateDataKesehatan () {
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